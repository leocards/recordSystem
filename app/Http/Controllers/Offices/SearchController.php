<?php

namespace App\Http\Controllers\Offices;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class SearchController extends Controller 
{
    public static function search($search = null, Request $request)
    {
        try {
            
            return response()->json(Office::where('name', 'like', "%{$search}%")->get(['id', 'name']));

        } catch (\Throwable $th) {
            return response()->json('error: '.$th->getMessage());
        }
    }
}