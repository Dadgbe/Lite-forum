<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.passwords.change');
    }
}
