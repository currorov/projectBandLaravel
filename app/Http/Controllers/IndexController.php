<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    function checkLogin(Request $req) {
        session(["activeForm" => "login"]);
        $this->validate($req, [
            'usernameLogin' => 'required',
            'passwordLogin' => 'required'
        ]);

        $username = $req->usernameLogin;
        $password = $req->passwordLogin;
        if(auth::attempt(['name' => $username, 'password' => $password])) {
            return redirect()->route('main');
        }

        return back()->withErrors([
            "password" => "Incorrect credentials"
        ])->onlyInput('passwordLogin');
    }

    function checkRegister(Request $req) {
        session(["activeForm" => "register"]);
        $this->validate($req, [
            'nameSingup' => 'required',
            'bandnameSingup' => 'required',
            'mailSingup' => 'required',
            'passwordSingup' => 'required',
            'confirmPasswordSingup' => 'required',
        ]);
        return redirect()->route('home');
    }

    function checkRecoverPass(Request $req) {
        session(["activeForm" => "recoverPassword"]);
        $this->validate($req, [
            'mailRecoverPassword' => 'required',
        ]);
        return redirect()->route('home');
    }
}
