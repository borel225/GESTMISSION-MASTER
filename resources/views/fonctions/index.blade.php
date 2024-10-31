@extends('layouts.app')


@section('content')

<div class="container">
    <h1>Liste des Fonctions</h1>
    @role('Administrateur')
    <a href="{{ route('fonctions.create') }}" class="btn btn-primary">Créer une Fonction</a>
    @endrole
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
                        @can('modification')
                        <a href="{{ route('fonctions.edit', $fonction->id) }}" class="btn btn-warning">Modifier</a>
                        @endcan
                         @can('suppression')
                         <form action="{{ route('fonctions.destroy', $fonction->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                         @endcan

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection
