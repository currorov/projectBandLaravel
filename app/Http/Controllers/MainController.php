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
        session()->forget('activeTable');
        $activeBand = session('activeBand');

        $arrayInstruments = Instrument::where("band_id", $activeBand->id)->get();

        $types = [];
        $familys = [];

        foreach ($arrayInstruments as $key => $instrument) {
            if (!in_array($instrument->type, $types)) {
                $types[] = $instrument->type;
            }
            if (!in_array($instrument->family, $familys)) {
                $familys[] = $instrument->family;
            }
        }
        
        return view('main', compact('arrayInstruments', 'types', 'familys'));
    }

    function filterInstruments(Request $req) {
        $activeBand = session('activeBand');

        $arrayInstruments = Instrument::where("band_id", $activeBand->id)->get();

        $types = [];
        $familys = [];

        foreach ($arrayInstruments as $key => $instrument) {
            if (!in_array($instrument->type, $types)) {
                $types[] = $instrument->type;
            }
            if (!in_array($instrument->family, $familys)) {
                $familys[] = $instrument->family;
            }
        }

        $familyfilter = $req->familyfilter;
        if (!empty($familyfilter) && $familyfilter != 'All') {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($familyfilter) {
                return $instrument->family == $familyfilter;
            });
        }
        $typefilter = $req->typefilter;
        if (!empty($typefilter)) {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($typefilter) {
                return in_array($instrument->type, $typefilter);
            });
        }
        $brandfilter = $req->brandFilter;
        if (!empty($brandfilter)) {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($brandfilter) {
                return strtolower($instrument->brand) == strtolower($brandfilter);
            });
        }
        $modelfilter = $req->modelFilter;
        if (!empty($modelfilter)) {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($modelfilter) {
                return strtolower($instrument->model) == strtolower($modelfilter);
            });
        }
        $serialfilter = $req->serialNumberFilter;
        if (!empty($serialfilter)) {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($serialfilter) {
                return strtolower($instrument->serial_number) == strtolower($serialfilter);
            });
        }
        $statefilter = $req->stateFilter;
        if (!empty($statefilter) && $statefilter != "all") {
            $arrayInstruments = $arrayInstruments->filter(function ($instrument) use ($statefilter) {
                return $instrument->state == $statefilter;
            });
        }
        
        return view('main', compact('arrayInstruments', 'types', 'typefilter','familyfilter', 'brandfilter', 'modelfilter', 'serialfilter', 'statefilter', 'familys'));
        
    }


    
}
