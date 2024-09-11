@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Agents</h1>
    <a href="{{ route('agents.create') }}" class="btn btn-primary">Créer un agent</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Matricule</th>
                <th>Service</th>
                <th>Fonction</th>
                <th>Supérieur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agents as $agent)
            <tr>
                <td>{{ $agent->nom }}</td>
                <td>{{ $agent->prenom }}</td>
                <td>{{ $agent->matricule }}</td>
                <td>{{ $agent->service->libelle }}</td>
                <td>{{ $agent->fonction->libelle }}</td>
                <td> @if($agent->superieur)
                    {{ $agent->superieur->nom }}
                @else
                    Aucun supérieur
                @endif</td>
                <td>
                    <a href="{{ route('agents.edit', $agent) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('agents.destroy', $agent) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
