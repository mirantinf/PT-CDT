<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('print', $data);

        return $pdf->download('itsolutionstuff.pdf');
    }
}
