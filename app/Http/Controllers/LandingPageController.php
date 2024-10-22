<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LandingPageController extends Controller
{
    public function landing()
    {
        if (Auth::check()) {
            return redirect('login');
        }
        return view('landing');
    }


}
