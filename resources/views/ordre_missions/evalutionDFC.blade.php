@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Liste des Missions Validées</h1>
    @if ($missionsValidees->isEmpty())
        <p>Aucune mission validée trouvée.</p>
    @else
    <form method="POST" action="{{ route('validerMissionsdfc') }}">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Nom de l'agent</th>
                    <th>Nom de la mission</th>
                    <th>Destination</th>
                    <th>Date de Départ</th>
                    <th>Date de Retour</th>
                    <th>Action</th>
                    <th>Cellule mission</th>
                    <th>Valider</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($missionsValidees as $ordreMission)
                    <tr>
                        <td>{{ $ordreMission->agent->nom }} {{ $ordreMission->agent->prenom }}</td>
                        <td>{{ $ordreMission->mission->libelle }}</td>
                        <td>{{ $ordreMission->mission->destinationArrivee->libelle }}</td>
                        <td>{{ $ordreMission->mission->date_depart }}</td>
                        <td>{{ $ordreMission->mission->date_retour }}</td>
                        <td>
                            <a href="{{ route('demande', ['id' => $ordreMission->id]) }}" class="btn btn-warning btn-sm">Voir</a>
                        </td>
                        <td>
                            <span class="badge bg-success">{{ $ordreMission->statutcc }}</span>
                        </td>
                        <td>
                                @if($ordreMission->statutdfc === null) <!-- Si le statut n'est pas encore défini -->
                                <input type="checkbox" name="missions[]" value="{{ $ordreMission->id }}">
                            @else
                                <span class="badge bg-success">{{ $ordreMission->statutdfc }}</span> <!-- Affiche le badge -->
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
