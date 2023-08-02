<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Offices\SearchController;
use App\Models\Office;
use App\Models\OfficeRecord;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeRecordController extends Controller
{

    public function add_records_to_office(Request $request)
    {
        sleep(10);
        try {
            $added = collect([]);
            DB::transaction(function () use ($request, $added) {
                foreach ($request->offices as $key => $value) {
                    $add = OfficeRecord::create([
                        'record_id' => $request->record,
                        'office_id' => $value['id'],
                        'Due' => $value['due']
                    ]);
                    $office = Office::find($value['id']);
                    $added->push(collect([
                        'id' => $add->id,
                        'name' => $office->name,
                        'Due' => $add->Due
                    ]));
                }
            });

            return response()->json($added);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function search(Request $request, $search = null, $excludes = null)
    {
        if($excludes)
            $request['exclude'] = array_map(function ($val) {
            return intval($val);
            }, explode(',',$excludes));

        return SearchController::search($request, $search);
    }

    public function get_tagged_office(Record $officeRecord)
    {
        try {
            return response()->json(
                OfficeRecord::where('record_id', $officeRecord->id)
                    ->get()
                    ->map(function ($office) {
                        $setOffice = $office->getOfficesTagged;
                        
                        return collect([
                            'id' => $office->id,
                            'name' => $setOffice->name  
                        ]);
                    })
            );
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 452);
        }
    }

    public function deleteTag(Request $request)
    {
        try {

            OfficeRecord::find($request->id)->delete();

            return response()->json();

        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function update(Request $request, OfficeRecord $officeRecord)
    {
        //
    }

    public function destroy(OfficeRecord $officeRecord)
    {
        //
    }
}
