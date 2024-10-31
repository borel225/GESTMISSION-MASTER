@extends('layouts.app')

@section('content')

<div class="container">
    <h4 class="text-center text-muted mb-3">DEMANDE D'AUTORISATION DE MISSION</h4>
    <div class="row justify-content-center align-items-center">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Informations de l'Agent</div>
                    <div class="card-body">
                        <p class="card-text">Nom et Prénoms: {{ $agent->nom }} {{$agent->prenom}}</p>
                        <p class="card-text">Matricule: {{ $agent->matricule}}</p>
                        <p class="card-text">Direction: {{ $agent->service->direction->libelle}}</p>
                        <p class="card-text">Service: {{ $agent->service->libelle}}</p>
                        <p class="card-text">Fonction: {{ $agent->fonction->libelle}}</p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Informations de la Mission</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $ordreMission->mission->libelle }}</h5>
                        <p class="card-text">Destination: {{ $ordreMission->mission->destinationArrivee->libelle }}</p>
                        <p class="card-text">Objet de la mission: {{ $ordreMission->mission->objectif }}</p>
                        <p class="card-text">Intérêt pour le CCC: {{ $ordreMission->mission->interet }}</p>
                        <p class="card-text">Date de Départ: {{ $ordreMission->mission->date_depart }}</p>
                        <p class="card-text">Date de Retour: {{ $ordreMission->mission->date_retour }}</p>
                    </div>
                </div>@if($ordreMission->statut === 'demande validée')
                <div class="card mt-3">
                    <div class="card-header">Détails du calcul - Perdiem et carburant</div>
                    <div class="card-body">
                        @php
                            $dateDepart = \Carbon\Carbon::parse($ordreMission->mission->date_depart);
                            $dateRetour = \Carbon\Carbon::parse($ordreMission->mission->date_retour);
                            $nombreJours = $dateDepart->diffInDays($dateRetour) + 1;
                        @endphp
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Détails du Perdiem</h5>
                                <ul>
                                    <li>Type de mission : {{ $ordreMission->typeMission->libelle }}</li>
                                    <li>Catégorie de l'agent : {{ $ordreMission->agent->categorieAgent->libelle  }}</li>
                                    <li>Montant journalier : {{ number_format($ordreMission->getParametrePerdiem()->montant, 0) }} FCFA</li>
                                    <li>Date de départ : {{ $ordreMission->mission->date_depart }}</li>
                                    <li>Date de retour : {{ $ordreMission->mission->date_retour }}</li>
                                    <li>Nombre de jours : {{ $nombreJours }}</li>
                                    <li>Calcul : {{ number_format($ordreMission->getParametrePerdiem()->montant, 0) }} x {{ $nombreJours }} jours</li>
                                    <li><strong>Total Perdiem : {{ number_format($ordreMission->perdiem, 0) }} FCFA</strong></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Détails du Carburant</h5>
                                <ul>
                                    <li>Distance : {{ $ordreMission->distance }} Km</li>
                                    <li>Nombre de jours : {{ $nombreJours }}</li>
                                    <li>Calcul : {{ $ordreMission->distance }} km x {{ $nombreJours }} jours</li>
                                    <li><strong>Total Carburant : {{ number_format($ordreMission->carburant, 0) }} FCFA</strong></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h5>Récapitulatif</h5>
                                <ul>
                                    <li>Total Perdiem : {{ number_format($ordreMission->perdiem, 0) }} FCFA</li>
                                    <li>Total Carburant : {{ number_format($ordreMission->carburant, 0) }} FCFA</li>
                                    <li><strong>Montant Total de la Mission : {{ $total }} FCFA</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <form action="{{ route('submit_demande', ['id' => $ordreMission->id]) }}" method="POST" class="mt-3">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mb-3 text-center">
                            <div class="card-header text-center"><h5>Signature du demandeur</h5></div>
                            <div class="card-body">
                                <h5 class="card-title">Cocher</h5>
                                <input class="form-check-input" type="checkbox" id="validation_agent" name="validation_agent" value="1"
                                       {{ $ordreMission->validation_agent ? 'checked disabled' : ($userLevel == 'agent' || $userAgent->id == $agent->id ? '' : 'disabled') }}>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3 text-center">
                            <div class="card-header text-center"><h5>Avis Supérieur Hiérarchique</h5></div>
                            <div class="card-body">
                                <h5 class="card-title">Cocher</h5>
                                <input class="form-check-input" type="checkbox" id="validation_sup_hier" name="validation_sup_hier" value="1"
                                       {{ $ordreMission->validation_sup_hier ?  'checked disabled' : ($userLevel == 'sup_hier' && $ordreMission->validation_agent ? '' : 'disabled') }}>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3 text-center">
                            <div class="card-header text-center"><h5>Avis du Directeur Adjoint</h5></div>
                            <div class="card-body">
                                <h5 class="card-title">Cocher</h5>
                                <input class="form-check-input" type="checkbox" id="validation_da" name="validation_da" value="1"
                                       {{ $ordreMission->validation_da ? 'checked disabled' : ($userLevel == 'da' && $ordreMission->validation_sup_hier ? '' : 'disabled') }}>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3 text-center">
                            <div class="card-header text-center"><h5>Avis du Directeur du Département</h5></div>
                            <div class="card-body">
                                <h5 class="card-title">Cocher</h5>
                                <input class="form-check-input" type="checkbox" id="validation_dd" name="validation_dd" value="1"
                                       {{ $ordreMission->validation_dd ? 'checked disabled' : ($userLevel == 'dd' && $ordreMission->validation_da ? '' : 'disabled') }}>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3 text-center">
                            <div class="card-header text-center"><h5>RESERVE A LA DIRECTION GENERALE</h5></div>
                            <div class="card-body">
                                <h5 class="card-title">Cocher</h5>
                                <input class="form-check-input" type="checkbox" id="validation_dg" name="validation_dg" value="1"
                                {{ $ordreMission->validation_dg ? 'checked disabled' : ($userLevel =='dg' && $ordreMission->validation_dg ? 'disabled' : '') }}>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($ordreMission->statut !== 'demande validée')
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">Soumettre la Demande</button>
                    </div>
                @endif
            </form>
            </div>
        </div>
    </div>
</div>

@endsection
