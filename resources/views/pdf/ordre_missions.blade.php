@extends('layouts.pdf')

@section('content')
<div class="container">
    <div class="title-container">
        <h4>ORDRE DE MISSION</h4>
    </div>


        <div class="card">
            <div class="card-body">
                <p>Nom et Prénoms: {{ $agent->nom }} {{ $agent->prenom }}</p>
                <p>Matricule: {{ $agent->matricule }}</p>
                <p>Direction: {{ $agent->service->direction->libelle}}</p>
                <p>Service: {{ $agent->service->libelle }}</p>
                <p>Fonction: {{ $agent->fonction->libelle }}</p>
                <hr>
                <p>Destination: {{ $ordreMission->mission->destinationArrivee->libelle }}</p>
                <p>Objet de la mission: {{ $ordreMission->mission->objectif }}</p>
                <p>Date de Départ: {{ $ordreMission->mission->date_depart }}</p>
                <p>Date de Retour: {{ $ordreMission->mission->date_retour }}</p>

            </div>
        </div>



        <table class="signature-section">
            <tr>
                <td class="signature-card">
                    <h5>Signature DFC</h5>
                    <input type="checkbox" {{ $ordreMission->validation_agent ? 'checked disabled' : '' }}>
                </td>
                <td class="signature-card">

                </td>
                <td class="signature-card">

                </td>
                <td class="signature-card">
                    <h5>DRH</h5>
                    <input type="checkbox" {{ $ordreMission->validation_dd ? 'checked disabled' : '' }}>
                </td>
            </tr>
        </table>

    </div>

</div>
@endsection

