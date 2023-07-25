<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Office", [
            'offices' => Office::all()
        ]);
    }

    public function _validation_(Request $request, Office $office = null)
    {
        $request->validate([
            'name' => ['required', 'max:254', 
                Rule::unique('offices')->where(function ($query) use ($request, $office) {
                    if($office)
                        $query->whereNot('id', $office->id)->where('name', $request->name);
                    else
                        $query->where('name', $request->name);
                }) 
            ]
        ], [
            'name.unique' => 'This office already exist',
            'name.required' => 'Office name is required.'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->_validation_($request);

        DB::beginTransaction();
        try {

            Office::create([
                'name' => trim($request->name)
            ]);

            DB::commit();
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Office $office)
    {
        $this->_validation_($request, $office);

        DB::beginTransaction();
        try {

            $office->name = trim($request->name);
            $office->save();

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
    public function destroy(Office $office)
    {
        //
    }
}
