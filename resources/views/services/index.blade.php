@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Liste des Services</h1>
    <a href="{{ route('services.create') }}" class="btn btn-primary">Créer un Service</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Direction</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->libelle }}</td>
                    <td>{{ $service->direction ? $service->direction->libelle : 'Aucune direction' }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
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
