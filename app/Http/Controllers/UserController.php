<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    
    public function index() 
    {
        return Inertia::render('User');
    }

    public function userSearch(Request $request, $search = null) 
    {
        try {
            if($request->exclude)
                return response()->json(User::where('name', 'like', "%{$search}%")->whereNotIn('id', $request->exclude)->get(['id', 'name']));
            else
                return response()->json(User::where('name', 'like', "%{$search}%")->get(['id', 'name']));

        } catch (\Throwable $th) {
            return response()->json('error: '.$th->getMessage());
        }
    }

}
