@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($fonction->id) ? 'Modifier la Fonction' : 'Créer une Fonction' }}</h1>

    <form action="{{ isset($fonction->id) ? route('fonctions.update', $fonction->id) : route('fonctions.store') }}" method="POST">
        @csrf
        @if(isset($fonction->id))
            @method('PUT') <!-- Pour une mise à jour -->
        @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="libelle" class="label-form">Nom de la fonction :</label>
                        <input type="text" name="libelle" id="libelle" class="form-control" value="{{ old('libelle', $fonction->libelle) }}" required>
                    </div>

                </div>
            </div>

        <button type="submit" class="btn btn-primary mt-3">{{ isset($fonction->id) ? 'Enregistrer' : 'Enregistrer' }}</button>
    </form>
</div>
@endsection
