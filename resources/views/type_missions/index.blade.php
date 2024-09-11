@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Types de Mission</h1>
    <a href="{{ route('type_missions.create') }}" class="btn btn-primary">Créer un Nouveau Type de Mission</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($typesMissions as $typesMission)
                <tr>
                    <td>{{ $typesMission->libelle }}</td>
                    <td>
                        <a href="{{ route('type_missions.edit', $typesMission->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('type_missions.destroy', $typesMission->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
</div>
@endsection
