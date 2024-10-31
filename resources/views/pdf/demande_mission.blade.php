@extends('layouts.pdf')

@section('content')
<div class="container">
    <div class="title-container">
        <h4>DEMANDE D'AUTORISATION DE MISSION</h4>
    </div>
    @php
    use Carbon\Carbon;
    @endphp
    <div class="date">
        <p>Date : {{ Carbon::parse($ordreMission->mission->created_at)->format('d/m/Y') }}</p>
    </div>

        <div class="card">
            <div class="card-body">
                <p>Nom et Prénoms: {{ $agent->nom }} {{ $agent->prenom }}</p>
                <p>Matricule: {{ $agent->matricule }}</p>
                <p>Direction: {{ $agent->service->direction->libelle}}</p>
                <p>Service: {{ $agent->service->libelle }}</p>
                <p>Fonction: {{ $agent->fonction->libelle }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p>Destination: {{ $ordreMission->mission->destinationArrivee->libelle }}</p>
                <p>Objet de la mission: {{ $ordreMission->mission->objectif }}</p>
                <p>Date de Départ: {{ $ordreMission->mission->date_depart }}</p>
                <p>Date de Retour: {{ $ordreMission->mission->date_retour }}</p>
            </div>
        </div>

        <table class="signature-section">
            <tr>
                <td class="signature-card">
                    <h5>Signature du demandeur</h5>
                    <input type="checkbox" {{ $ordreMission->validation_agent ? 'checked disabled' : '' }}>
                </td>
                <td class="signature-card">
                    <h5>Avis Supérieur Hiérarchique</h5>
                    <input type="checkbox" {{ $ordreMission->validation_sup_hier ? 'checked disabled' : '' }}>
                </td>
                <td class="signature-card">
                    <h5>Avis du Directeur Adjoint</h5>
                    <input type="checkbox" {{ $ordreMission->validation_da ? 'checked disabled' : '' }}>
                </td>
                <td class="signature-card">
                    <h5>Avis du Directeur du Département</h5>
                    <input type="checkbox" {{ $ordreMission->validation_dd ? 'checked disabled' : '' }}>
                </td>
            </tr>
            <tr>
                <td class="signature-card" colspan="4">
                    <h5>RESERVE A LA DIRECTION GENERALE</h5>
                    <input type="checkbox" {{$ordreMission->validation_dg ? 'checked disabled' : ''}}>
                </td>
            </tr>
        </table>

    </div>

</div>
@endsection

