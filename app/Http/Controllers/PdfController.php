<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\User;
use App\Models\Instrument;

class PdfController extends Controller
{
    public function generarPDF()
    {
        $bandSession = session('activeBand');
        $instruments = Instrument::where("band_id", $bandSession->id)->get();
        $data = [
            'title' => $bandSession->bandname,
            'instruments' => $instruments,
        ];
        $pdf = PDF::loadView('generatePDF', $data);

        return $pdf->download('instruments.pdf');
    }
}
