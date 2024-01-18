<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Instrument;


class MainController extends Controller
{
    function logout() {
        Auth::logout();

        session_start(); 
        session_destroy();

        session_start();
        session(["activeForm" => "login"]);

        return redirect()->route('index');
    }
    function viewMain() {
        $activeBand = session('activeBand');

        $arrayInstruments = Instrument::where("band_id", $activeBand->id)->get();

        $familys = [];

        foreach ($arrayInstruments as $key => $instrument) {
            if (!in_array($instrument->family, $familys)) {
                $familys[] = $instrument->family;
            }
        }
        
        return view('main', compact('arrayInstruments', 'familys'));
    }

    function filterInstruments(Request $req) {
        $activeBand = session('activeBand');

        $arrayInstruments = Instrument::where("band_id", $activeBand->id)->get();

        $familys = [];

        foreach ($arrayInstruments as $key => $instrument) {
            if (!in_array($instrument->family, $familys)) {
                $familys[] = $instrument->family;
            }
        }

        $familyfilter = $req->familyfilter;
        if (!empty($familyfilter)) {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($familyfilter) {
                return in_array($instrument->family, $familyfilter);
            });
        }
        $brandfilter = $req->brandFilter;
        if (!empty($brandfilter)) {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($brandfilter) {
                return $instrument->brand == $brandfilter;
            });
        }
        $modelfilter = $req->modelFilter;
        if (!empty($modelfilter)) {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($modelfilter) {
                return $instrument->model == $modelfilter;
            });
        }
        $serialfilter = $req->serialNumberFilter;
        if (!empty($serialfilter)) {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($serialfilter) {
                return $instrument->serial_number == $serialfilter;
            });
        }
        $statefilter = $req->stateFilter;
        if (!empty($statefilter) && $statefilter != "all") {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($statefilter) {
                return $instrument->state == $statefilter;
            });
        }
        
        return view('main', compact('arrayInstruments', 'familys', 'familyfilter', 'brandfilter', 'modelfilter', 'serialfilter', 'statefilter'));
        
    }


    
}
