<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function showRegistrationForm(){
        return view('auth.registration');
    }

    public function registration(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'email'=> 'required|string|email|max:100|unique:users',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'=>'required|string|min:8|confirmed',
        ],[
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        if($request->get('password') !== $request->get('password_confirmation')){
            return redirect()->back()->withErrors(['password_confirmation' => 'The password confirmation does not match.'])->withInput();
        }

        $user = User::create([
             'name' => $validatedData['name'],
            'email' =>$validatedData['email'],
            'password'=>Hash::make($validatedData['password'])
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/avatars');
            $user->avatar = basename($imagePath);
            $user->save();
        }

        session()->flash('success','Registration successful! Please log in.');

        return redirect('/login');

    }
    public function logining(Request $request){

        $credentials = $request->validate([
            'email'=> 'required|email',
            'password'=>'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/');
        }
        else {
            return redirect()->back()->withErrors([
                'login' => 'Invalid credentials. Please try again.'
            ]);
        }

    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
