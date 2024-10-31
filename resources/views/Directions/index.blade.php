@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Directions</h1>
        <a href="{{ route('directions.create') }}" class="btn btn-primary">Créer une nouvelle direction</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nom de la direction</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($directions as $direction)
                    <tr>
                        <td>{{ $direction->libelle }}</td>
                        <td>
                            <a href="{{ route('directions.edit', $direction) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('directions.destroy', $direction) }}" method="POST" style="display:inline;">
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
