@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <h1 class="text-center mb-3 mt-3">Liste des missions</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Intitulé</th>
                    <th scope="col">Objectif</th>
                    <th scope="col">Date de départ</th>
                    <th scope="col">Date de retour</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($missions as $mission)
                    <tr>
                        <td>{{ $mission->libelle }}</td>
                        <td>{{ $mission->objectif }}</td>
                        <td>{{ $mission->date_depart }}</td>
                        <td>{{ $mission->date_retour}}</td>
                        <td>
                            <a href="{{ route('missions.show', $mission->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('missions.edit', $mission->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('missions.destroy', $mission->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <a href="{{ route('missions.create') }}" class="btn btn-primary">Créer une nouvelle mission</a>
        </div>
    </div>
</div>

@endsection
