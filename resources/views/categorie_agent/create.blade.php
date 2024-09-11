@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Créer une Nouvelle Catégorie</h1>
    <form action="{{ route('categorie_agent.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                    <label for="libelle" class="form-label">Nom de la catégorie :</label>
                    <input type="text" id="libelle" name="libelle" value="{{ old('libelle') }}" class="form-control" required>
                    @error('libelle')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
                <a href="{{ route('categorie_agent.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
            </div>
        </div>
    </form>
</div>

@endsection
