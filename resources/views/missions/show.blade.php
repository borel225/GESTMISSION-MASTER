@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="text-center mb-3 mt-3">Détails de la mission</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Intitulé de la mission : {{ $mission->libelle }}</h5>
                    <p class="card-text"><strong>Objectif :</strong> {{ $mission->objectif }}</p>
                    <p class="card-text"><strong>Date de départ :</strong> {{ $mission->date_depart }}</p>
                    <p class="card-text"><strong>Date de retour :</strong> {{ $mission->date_retour }}</p>
                    <p class="card-text"><strong>Intérêt de la mission :</strong> {{ $mission->interet }}</p>

                    @if ($mission->tdr)
                        <p class="card-text"><strong>TDR :</strong> <a href="{{ asset('storage/' . $mission->tdr) }}" target="_blank">Voir le fichier</a></p>
                    @endif

                    <p class="card-text"><strong>Destination de départ :</strong> {{ $mission->destinationDepart->libelle }}</p>
                    <p class="card-text"><strong>Destination d'arrivée :</strong> {{ $mission->destinationArrivee->libelle }}</p>

                    <p class="card-text"><strong>Observations :</strong> {{ $mission->observation }}</p>

                    <!-- Affichage des agents participants -->
                    @if ($mission->agents->count() > 0)
                        <p class="card-text"><strong>Agents participants :</strong></p>
                        <ul>
                            @foreach ($mission->agents as $agent)
                                <li>{{ $agent->nom }} {{ $agent->prenom }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="card-text"><strong>Agents participants :</strong> Aucun agent associé.</p>
                    @endif

                    <a href="{{ route('missions.index') }}" class="btn btn-primary">Retour aux missions</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
