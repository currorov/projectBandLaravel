<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    function viewRegistration() {
        return view("registration");
    }
}
