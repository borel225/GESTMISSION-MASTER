@extends('layouts.app')


@section('content')

<div class="container">
    <h1>Liste des Fonctions</h1>
    <a href="{{ route('fonctions.create') }}" class="btn btn-primary">Créer une Fonction</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fonctions as $fonction)
                <tr>
                    <td>{{ $fonction->libelle }}</td>
                    <td>
                        <a href="{{ route('fonctions.edit', $fonction->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('fonctions.destroy', $fonction->id) }}" method="POST" style="display:inline;">
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
