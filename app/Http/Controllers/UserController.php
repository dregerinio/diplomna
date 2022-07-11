<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function getInfo(){
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function updateInfo(Request $request){
        $user = Auth::user();

        $user->name = $request->post('name');
        $user->save();
        
        return view('welcome');
    }
}
