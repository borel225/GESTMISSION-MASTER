@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Modifier la Catégorie</h1>
    <form action="{{ route('categorie_agent.update', $categorie->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <label for="liblle" class="form-label">Nom de la catégorie :</label>
                <input type="text" id="libelle" name="libelle" value="{{ old('liblle', $categorie->libelle) }}" class="form-control" required>
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
