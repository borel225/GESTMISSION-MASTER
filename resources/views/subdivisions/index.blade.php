@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Subdivisions</h1>
    <a href="{{ route('subdivisions.create') }}" class="btn btn-primary">Créer une nouvelle subdivision</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom de la subdivision</th>
                <th>Subdivision parent</th>
                <th>Chef</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subdivisions as $subdivision)
                <tr>
                    <td>{{ $subdivision->libelle }}</td>
                    <td>{{ $subdivision->parent ? $subdivision->parent->libelle : 'Aucun' }}</td>
                    <td>{{ $subdivision->chef ? $subdivision->chef->nom : 'Aucun' }} {{ $subdivision->chef ? $subdivision->chef->prenom : 'Aucun' }}</td>
                    <td>
                        <a href="{{ route('subdivisions.edit', $subdivision) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('subdivisions.destroy', $subdivision) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
@endsection

