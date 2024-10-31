<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\OrdreMission;
use App\Models\Agent;


class PdfController extends Controller
{
    //
    public function generatePDF($id)
        {
            // Récupérer les données nécessaires
        $ordreMission = OrdreMission::find($id);
        $agent = $ordreMission->agent;

        // Générer le PDF
        $pdf = Pdf::loadView('pdf.demande_mission', [
            'ordreMission' => $ordreMission,
            'agent' => $agent,
        ]);

        return $pdf->stream('demande_mission.pdf');
    }


    public function generatePDFOrdreMission($id)
    {
        // Récupérer les données nécessaires
    $ordreMission = OrdreMission::find($id);
    $agent = $ordreMission->agent;

    // Générer le PDF
    $pdf = Pdf::loadView('pdf.ordre_missions', [
        'ordreMission' => $ordreMission,
        'agent' => $agent,
    ]);

    return $pdf->stream('ordre_missions.pdf');
}


}

