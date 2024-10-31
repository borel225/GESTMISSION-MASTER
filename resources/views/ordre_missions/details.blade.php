@extends('layouts.app')

@section('content')

<div class="container">
    <h4 class="text-center text-muted mb-3">MONTANT PERDIEM ET CARBURANT</h4>
    <div class="row justify-content-center align-items-center">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Montant Perdiem</div>
                    <div class="card-body">
                        @php
                        $dateDepart = \Carbon\Carbon::parse($ordreMission->mission->date_depart);
                        $dateRetour = \Carbon\Carbon::parse($ordreMission->mission->date_retour);
                        $nombreJours = $dateDepart->diffInDays($dateRetour) + 1;
                    @endphp
                        <p class="card-text">Type de mission : {{ $ordreMission->typeMission->libelle }}</p>
                        <p class="card-text">Catégorie de l'agent : {{ $ordreMission->agent->categorieAgent->libelle  }}</p>
                        <p class="card-text">Montant journalier : {{ number_format($ordreMission->getParametrePerdiem()->montant, 0) }} FCFA</p>
                        <p class="card-text">Date de départ : {{ $ordreMission->mission->date_depart }}</p>
                        <p class="card-text">Date de Retour: {{ $ordreMission->mission->date_retour }}</p>
                        <p class="card-text">Nombre de jours : {{ $nombreJours }}</p>
                        <p class="card-text">Calcul : {{ number_format($ordreMission->getParametrePerdiem()->montant, 0) }} x {{ $nombreJours }} jours</p>
                        <p class="card-text"><strong>Total Perdiem : {{ number_format($ordreMission->perdiem, 0) }} FCFA</strong></p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Montant du Carburant</div>
                    <div class="card-body">
                        <h5 class="card-title">Distance : {{ $ordreMission->distance }} Km</h5>
                        <p class="card-text">Nombre de jours : {{ $nombreJours }}</p>
                        <p class="card-text">Calcul : {{ $ordreMission->distance }} km x {{ $nombreJours }} jours</p>
                        <p class="card-text"><strong>Total Carburant : {{ number_format($ordreMission->carburant, 2) }} FCFA</strong></p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Récapitulatif</div>
                    <div class="card-body">
                        <h5 class="card-title">Total Perdiem : {{ number_format($ordreMission->perdiem, 2) }} FCFA</h5>
                        <p class="card-text">Total Carburant : {{ number_format($ordreMission->carburant, 2) }} FCFA</p>
                        <p class="card-text"><strong>Montant Total de la Mission : {{ $total }} FCFA</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
