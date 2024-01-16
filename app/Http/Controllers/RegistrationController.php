<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Instrument;


class RegistrationController extends Controller
{
    function viewRegistration() {
        return view("registration");
    }

    function insertInstrument(Request $req) {
        $this->validate($req, [
            'family' => 'required|regex:/^[a-zA-Z\s]+$/',
            'type' => 'required|regex:/^[a-zA-Z\s]+$/',
            'brand' => 'required|regex:/^[a-zA-Z\s]+$/',
            'model' => 'required',
            'serial_number' => 'nullable',
            'acquisition_date' => 'nullable',
            'state' => 'required',
            'comment' => 'nullable',
            'image' => 'nullable|file|image',
        ]);

        $instrument = new Instrument();
        $instrument->family = ucwords(strtolower($req->family));
        $instrument->type = $req->type;
        $instrument->brand = $req->brand;
        $instrument->model = $req->model;
        if($req->serial_number != null){
            $instrument->serial_number = $req->serial_number;
        }
        if($req->acquisition_date != null){
            $instrument->acquisition_date = $req->acquisition_date;
        }   
            $instrument->state = $req->state;
        if($req->comment != null){
            $instrument->comment = $req->comment;
        }
        $activeBand = session('activeBand');
        if ($req->hasFile('image')) {

            $file = $req->file('image');
            $fileName = uniqid('ins_'.$activeBand->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/instruments'), $fileName);

            $path = 'uploads/instruments/' . $fileName;
            echo $path;
            $instrument->image = $path;
        }
        $instrument->band_id = $activeBand->id;

        $instrument->save();

        return redirect()->route('main');
    }
}
