<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            "passwordLogin" => "Incorrect credentials"
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

        $emalRepeat = User::where("email", $req->mailSingup)->first();
        $nameRepeat = User::where("name", $req->nameSingup)->first();
        if(is_null($nameRepeat)){
            if(is_null($emalRepeat)){
                $username = $req->nameSingup;
                $password = $req->passwordSingup;

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
                } else if(session('bandlogo') != null){
                    session(['bandlogo' => null]);
                }
                $user->save();
                
                if(auth::attempt(['name' => $username, 'password' => $password])) {
                    $band = User::where('name', $username)->first();
        
                    session(['activeBand' => $band]);
                    session(['bandname' => $band->bandname]);
        
                    if($band->logo != null) {
                        session(['bandlogo' => $band->logo]);
                    }

                    
        
                    return redirect()->route('main');
                }
            } else {
                return back()->withErrors([
                    "photoSingup" => "Email already exists"
                ])->withInput();
            }
        }else {
            return back()->withErrors([
                "photoSingup" => "Name already exists"
            ])->withInput();
        }
    }

    function checkRecoverPass(Request $req) {
        session(["activeForm" => "recoverPassword"]);
        $this->validate($req, [
            'mailRecoverPassword' => 'required|email',
            'passwordRecover' => 'required',
        ]);
        $emailRecover = $req->mailRecoverPassword;

        $bands = User::all();

        foreach ( $bands as $band ) {
            $email = $band->email;
            if($email == $emailRecover) {
                User::where('id', $band->id)
                ->update(['password' => bcrypt($req->passwordRecover)]);

                $adminEmail = $band->email;
                $subject = 'Password changed successfully';
                $message = 'Your password is ' . $req->passwordRecover;

                Mail::to($adminEmail)->send(new \App\Mail\SendMail($subject, $message));
                session(["activeForm" => "login"]);
                return redirect()->route('main');
            }
        }
        
        return redirect()->route('index')->with('error', 'Email not found');
    }
}

