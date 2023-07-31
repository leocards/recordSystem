<?php

namespace App\Http\Controllers\Offices;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class SearchController extends Controller 
{
    public static function search(Request $request, $search = null)
    {
        try {
            if($request->exclude)
                return response()->json(Office::where('name', 'like', "%{$search}%")->whereNotIn('id', $request->exclude)->get(['id', 'name']));
            else
                return response()->json(Office::where('name', 'like', "%{$search}%")->get(['id', 'name']));

        } catch (\Throwable $th) {
            return response()->json('error: '.$th->getMessage());
        }
    }
}