<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class UserContoller extends Controller
{
    public function showSettings(){
        $user = Auth::user();
        $user_agent = new Agent();

        $browser = $user_agent->browser();
        $version = $user_agent->version($browser);
        return view('user.settings', compact('user','browser','version'));
    }
}
