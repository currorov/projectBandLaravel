<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instrument;
use App\Models\Revision;
use App\Models\Loan;

class InfoInstrumentcontroller extends Controller
{
    function viewIntrumentInfo($id) {
        $instrument = Instrument::where("id", $id)->get();
        $loans = Loan::where("instrument_id", $id)->get();
        return view('infoInstrument', [
            'loans' => $loans,
            'instrument' => $instrument[0],
        ]);
    }

    function loadLoans($id) {
        session(["activeTable" => "loans"]);
    
        $loans = Loan::where("instrument_id", $id)->get();
        $instrument = Instrument::where("id", $id)->get();
    
        return view('infoInstrument', [
            'loans' => $loans,
            'instrument' => $instrument[0],
        ]);
    }

    function loadRevisions($id) {
        session(["activeTable" => "revisions"]);

        $instrument = Instrument::where("id", $id)->get();
        $revisions = Revision::where("instrument_id", $id)->get();

        return view('infoInstrument', [
            'revisions' => $revisions,
            'instrument' => $instrument[0],
        ]);
    }

}
