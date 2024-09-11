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
                </div>

                <form action="{{ route('submit_demande', ['id' => $ordreMission->id]) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card mb-3 text-center">
                                <div class="card-header text-center"><h5>Signature du demandeur</h5></div>
                                <div class="card-body">
                                    <h5 class="card-title">Cocher</h5>
                                    <input class="form-check-input" type="checkbox" id="validation_agent" name="validation_agent" value="1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-3 text-center">
                                <div class="card-header text-center"><h5>Avis Supérieur Hiérarchique</h5></div>
                                <div class="card-body">
                                    <h5 class="card-title">Cocher</h5>
                                    <input class="form-check-input" type="checkbox" id="validation_sup_hier" name="validation_sup_hier" value="1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-3 text-center">
                                <div class="card-header text-center"><h5>Avis du Directeur Adjoint</h5></div>
                                <div class="card-body">
                                    <h5 class="card-title">Cocher</h5>
                                    <input class="form-check-input" type="checkbox" id="validation_da" name="validation_da" value="1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-3 text-center">
                                <div class="card-header text-center"><h5>Avis du Directeur du Département</h5></div>
                                <div class="card-body">
                                    <h5 class="card-title">Cocher</h5>
                                    <input class="form-check-input" type="checkbox" id="validation_dd" name="validation_dd" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">Soumettre la Demande</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
