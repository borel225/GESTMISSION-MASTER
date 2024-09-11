@extends('layouts.app')

@section('content')

<div class="container">
   <h1>liste des categories d'agents</h1>
   <a href="{{ route('categorie_agent.create') }}" class="btn btn-primary">Créer une Nouvelle Catégorie</a>
   <table class="table mt-3">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $categorie)
            <tr>
                <td>{{ $categorie->libelle }}</td>
                <td>
                    <a href="{{ route('categorie_agent.edit', $categorie->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('categorie_agent.destroy', $categorie->id) }}" method="POST" style="display: inline;">
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

