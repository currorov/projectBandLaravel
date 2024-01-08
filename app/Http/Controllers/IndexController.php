<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    function checkLogin(Request $req) {
        session(["activeForm" => "login"]);
        $this->validate($req, [
            'usernameLogin' => 'required',
            'passwordLogin' => 'required'
        ]);
        return redirect()->route('main');
    }

    function checkRegister(Request $req) {
        session(["activeForm" => "register"]);
        $this->validate($req, [
            'nameSingup' => 'required',
            'usernameSingup' => 'required',
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
