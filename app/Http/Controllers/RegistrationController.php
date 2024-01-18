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
        //prueba
        $activeBand = session('activeBand');
        $this->validate($req, [
            'family' => 'required|regex:/^[a-zA-Z\s]+$/',
            'type' => 'required|regex:/^[a-zA-Z\s]+$/',
            'brand' => 'required|regex:/^[a-zA-Z\s]+$/',
            'model' => 'required',
            'serial_number' => 'nullable',
            'acquisition_date' => 'nullable',
            'state' => 'required',
            'comment' => 'nullable|string|max:50',
            'image' => 'nullable|file|image',
        ]);

        $instrumentRepeat = Instrument::where("serial_number", $req->serial_number)->where("band_id", $activeBand->id)->first();
        if(is_null($instrumentRepeat)){
            $instrument = new Instrument();
            $instrument->family = ucwords(strtolower($req->family));
            $instrument->type = ucwords(strtolower($req->type));
            $instrument->brand = ucwords(strtolower($req->brand));
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
        } else {
            return back()->withErrors([
                "image" => "Serial number already exists"
            ])->withInput();
        }
    }
}
