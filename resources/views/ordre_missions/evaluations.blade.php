@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Liste des Missions</h1>
    @if ($missions->isEmpty())
        <p>Aucune mission trouvée.</p>
    @else
        <form method="POST" action="{{ route('validerMissions') }}">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom de l'agent</th>
                        <th>Nom de la mission</th>
                        <th>Destination</th>
                        <th>Date de Départ</th>
                        <th>Date de Retour</th>
                        <th>Statut</th>
                        <th>Action</th>
                        <th>Valider</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($missions as $ordreMission)
                        <tr>
                            <td>{{ $ordreMission->agent->nom }} {{ $ordreMission->agent->prenom }}</td>
                            <td>{{ $ordreMission->mission->libelle }}</td>
                            <td>{{ $ordreMission->mission->destinationArrivee->libelle }}</td>
                            <td>{{ $ordreMission->mission->date_depart }}</td>
                            <td>{{ $ordreMission->mission->date_retour }}</td>
                            <td>
                                <span class="badge bg-success">{{ $ordreMission->statut }}</span>
                            </td>
                            <td>
                                <a href="{{ route('demande', ['id' => $ordreMission->id]) }}" class="btn btn-warning btn-sm">Voir</a>
                            </td>
                            <td>
                                @if($ordreMission->statutcc === null) <!-- Si le statut n'est pas encore défini -->
                                    <input type="checkbox" name="missions[]" value="{{ $ordreMission->id }}">
                                @else
                                    <span class="badge bg-success">{{ $ordreMission->statutcc }}</span> <!-- Affiche le badge -->
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Valider</button>
        </form>
    @endif
</div>
@endsection
