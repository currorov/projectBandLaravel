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
            $band = User::where('name', $username)->first();

            session(['activeBand' => $band]);
            session(['bandname' => $band->bandname]);

            if($band->logo != null) {
                session(['bandlogo' => $band->logo]);
            }

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
            'mailSingup' => 'required|email',
            'passwordSingup' => 'required',
            'confirmPasswordSingup' => 'required|same:passwordSingup',
            'photoSingup' => 'nullable|file|image',
        ]);

        $user = new User();
        $user->name = $req->nameSingup;
        $user->bandname = $req->bandnameSingup;
        $user->email = $req->mailSingup;
        $user->password = bcrypt($req->passwordSingup);
        
        if ($req->hasFile('photoSingup')) {
            $fechaActual = date("Y-m-d");

            $file = $req->file('photoSingup');
            $fileName = uniqid('logo_'.$req->nameSingup) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/bands'), $fileName);

            $path = 'uploads/bands/' . $fileName;
            echo $path;
            $user->logo = $path;
        }

        $user->save();

        session(['activeBand' => $user]);
        session(['bandname' => $user->bandname]);
        
        return redirect()->route('main');
    }

    function checkRecoverPass(Request $req) {
        session(["activeForm" => "recoverPassword"]);
        $this->validate($req, [
            'mailRecoverPassword' => 'required|email',
        ]);
        return redirect()->route('home');
    }
}
