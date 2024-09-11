@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Liste des Missions</h1>
    @if ($missions->isEmpty())
        <p>Aucune mission trouvée.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nom de la mission</th>
                    <th>Destination</th>
                    <th>Date de Départ</th>
                    <th>Date de Retour</th>
                    <th>Statut</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($missions as $ordreMission)
                    <tr>
                        <td>{{ $ordreMission->mission->libelle }}</td>
                        <td>{{ $ordreMission->mission->destinationArrivee->libelle }}</td>
                        <td>{{ $ordreMission->mission->date_depart }}</td>
                        <td>{{ $ordreMission->mission->date_retour }}</td>
                        <td>
                            @if ($ordreMission->statut === 'en attente')
                                <span class="badge bg-primary">{{ $ordreMission->statut }}</span>
                            @elseif ($ordreMission->statut === 'demande validée')
                                <span class="badge bg-success">{{ $ordreMission->statut }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $ordreMission->statut }}</span>
                            @endif
                        </td>
                        @if ($ordreMission->statut === 'en attente')
                            <td>
                                <a href="{{ route('demande', ['id' => $ordreMission->id]) }}" class="btn btn-warning btn-sm">Faire une demande</a>
                            </td>
                        @else
                            <td>
                                    <a href="{{ route('demande', ['id' => $ordreMission->id]) }}" class="btn btn-warning btn-sm">Imprimer</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
