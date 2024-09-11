@extends('layouts.app')


@section('content')

<div class="container">
    <h1>Créer une Fonction</h1>
    <form action="{{ route('fonctions.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="libelle">Nom de la fonction</label>
                    <input type="text" name="libelle" id="libelle" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
            </div>
        </div>

    </form>
</div>

@endsection
