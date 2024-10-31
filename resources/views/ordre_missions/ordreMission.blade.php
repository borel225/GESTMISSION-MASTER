@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Liste des Missions Validées</h1>
    @if ($missionsValidees->isEmpty())
        <p>Aucune mission validée trouvée.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nom de l'agent</th>
                    <th>Nom de la mission</th>
                    <th>Destination</th>
                    <th>Date de Départ</th>
                    <th>Date de Retour</th>
                    <th>Cellule mission</th>
                    <th>DFC</th>
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
                            <span class="badge bg-success">{{ $ordreMission->statutcc }}</span>
                        </td>
                        <td>
                            <span class="badge bg-success">{{ $ordreMission->statutdfc }}</span>
                        </td>
                        <td>
                            <a href="{{ route('ordre_missions.pdf', $ordreMission->id) }}" class="btn btn-secondary btn-sm">Télécharger PDF</a>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
