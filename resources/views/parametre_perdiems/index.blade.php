@extends('layouts.app')

@section('content')

<div class="container">

            <h1>Paramètres Perdiem</h1>
            <a href="{{ route('parametre_perdiems.create') }}" class="btn btn-primary mb-3">Ajouter un nouveau paramètre</a>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Type de Mission</th>
                        <th>Catégorie d'Agent</th>
                        <th>Montant</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parametrePerdiem as $parametre)
                        <tr>
                            <td>{{ $parametre->typeMission ? $parametre->typeMission->libelle : 'Non défini' }}</td>
                            <td>{{ $parametre->categorieAgent ? $parametre->categorieAgent->libelle : 'Non défini' }}</td>
                            <td>{{ $parametre->montant }}</td>
                            <td>
                                <a href="{{ route('parametre_perdiems.edit', $parametre->id) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('parametre_perdiems.destroy', $parametre->id) }}" method="POST" style="display:inline;">
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
