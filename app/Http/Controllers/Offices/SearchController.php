<?php

namespace App\Http\Controllers\Offices;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\OfficeRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller 
{
    public static function search(Request $request, $search = null)
    {
        try {
            if($request->exclude){
                return response()
                    ->json(
                        Office::where('name', 'like', "%{$search}%")
                        ->whereNotIn('id', $request->exclude)
                        ->get(['id', 'name'])
                        ->map(function ($offices) use ($request) {
                            $exist = OfficeRecord::where('office_id', $offices->id)
                                ->where('record_id', $request->record)
                                ->whereNull('deleted_at')
                                ->first();

                            if(!$exist)
                                return collect([
                                    'id' => $offices->id,
                                    'name' => $offices->name
                                ]);
                        })
                );
            }else
                return response()
                    ->json(
                        Office::where('name', 'like', "%{$search}%")
                        ->get(['id', 'name'])
                        ->map(function ($offices) use ($request) {
                            $exist = OfficeRecord::where('office_id', $offices->id)
                                ->where('record_id', $request->record)
                                ->whereNull('deleted_at')
                                ->first();

                            if(!$exist)
                                return collect([
                                    'id' => $offices->id,
                                    'name' => $offices->name
                                ]);
                        })
                    );

        } catch (\Throwable $th) {
            return response()->json('error: '.$th->getMessage());
        }
    }
}