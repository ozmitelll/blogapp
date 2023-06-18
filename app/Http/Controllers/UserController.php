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
            'password'=>'string|min:8|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $user->name = $validatedData['name'];
        $user->email= $validatedData['email'];
        if($validatedData['password']){
            $user->password = Hash::make($validatedData['password']);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/avatars');
            $user->avatar = basename($imagePath);
            $user->save();
        }
        else{
            $user->save();
        }


        return redirect()->route('user.settings')->with('success', 'Profile success updated.');
    }
}
