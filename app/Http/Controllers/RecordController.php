<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Http\Controllers\Records\RecordsViewController;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Record', [
            'records' => Record::whereNull('parent')->get()
        ]);
    }

    public function open_record(Record $record)
    {
        return RecordsViewController::open_record($record);
    }
    
    public function _validation_(Request $request, Record $record = null)
    {
        $request->validate([
            'name' => ['required', 'max:254',
                Rule::unique('records')->where(function ($query) use ($request, $record) {
                    if($record)
                        $query->whereNot('id', $record->id)->where('name', $request->name)
                        ->where('parent', $request->parent);
                    else
                        $query->where('name', $request->name)
                            ->where('parent', $request->parent);
                }) 
            ]
        ], [
            'name.unique' => 'This record already exist'
        ]);
    }

    /**
     * creates a new record in the database and creates folder
     */
    public function create(Request $request, Record $record = null)
    {
        $this->_validation_($request, $record);

        $repository_path = null;

        DB::beginTransaction();
        try {

            $records = DB::transaction(function () use ($request) {
                return Record::create([
                    'name' => trim($request->name),
                    'parent' => $request->parent
                ]);
            });

            //creates folder
            $repository_path = $this->createFolder($records->id, $records->name);
            Record::where('id', $records->id)->update(['path'=>$repository_path]);

            DB::commit();
            return back();

        } catch (\Throwable $th) {
            if($repository_path)
                Storage::deleteDirectory($repository_path);

            DB::rollBack();
            dd();
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        $this->_validation_($request, $record);

        $repository_path = null;
        $original_path = null;

        DB::beginTransaction();
        try {
            $original_path = $record->path;
            $repository_path = '/records/'.$record->id.'_'.$request->name;

            if(!Storage::move($record->path, $repository_path))
                throw new Exception("Failed to update", 1);

            $record->name = trim($request->name);
            $record->path = $repository_path;
            $record->save();

            DB::commit();
            return back();

        } catch (\Throwable $th) {
            DB::rollBack();
            dd();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        //
    }

    function createFolder($folderName, $originalName) {
        //get the title of a folder to create
        $repo = $folderName;
                
        //root repository's path
        $root_path = '/records/'.$repo.'_'.$originalName;

        if(Storage::makeDirectory($root_path))
            return $root_path;
        else throw new Exception("Failed to create", 1);
    }
}
