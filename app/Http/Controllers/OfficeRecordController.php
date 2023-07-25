<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Offices\SearchController;
use App\Models\OfficeRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add_records_to_office(Request $request)
    {
        
        try {
            DB::transaction(function () use ($request) {
                OfficeRecord::create([
                    'record_id' => $request->record,
                    'office_id' => $request->office
                ]);
            });
            return back();
        } catch (\Throwable $th) {
            dd();
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function search($search = null, Request $request)
    {
        return SearchController::search($search, $request);
    }

    /**
     * Display the specified resource.
     */
    public function show(OfficeRecord $officeRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OfficeRecord $officeRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OfficeRecord $officeRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OfficeRecord $officeRecord)
    {
        //
    }
}
