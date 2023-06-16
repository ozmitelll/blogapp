<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;

class UserController extends Controller
{
    public function showSettings(){
        $user = Auth::user();
        $user_agent = new Agent();

        $browser = $user_agent->browser();
        $version = $user_agent->version($browser);
        return view('user.settings', compact('user','browser','version'));
    }

    public function editUser(Request $request){
        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required',
            'email'=> 'required|string|email|max:100|unique:users,email,' . $user->id,
            'password'=>'required|string|min:8',
        ]);


        $user->name = $validatedData['name'];
        $user->email= $validatedData['email'];
        if($validatedData['password']){
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();


        return redirect()->route('user.settings')->with('success', 'Profile success updated.');
    }
}
