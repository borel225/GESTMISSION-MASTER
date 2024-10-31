@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($direction->id) ? 'Modifier la Fonction' : 'Créer une Fonction' }}</h1>

    <form action="{{ isset($direction->id) ? route('directions.update', $direction->id) : route('directions.store') }}" method="POST">
        @csrf
        @if(isset($direction->id))
            @method('PUT') <!-- Pour une mise à jour -->
        @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="libelle" class="label-form">Nom de la direction :</label>
                        <input type="text" name="libelle" id="libelle" class="form-control" value="{{ old('libelle', $direction->libelle) }}" required>
                    </div>

                </div>
            </div>

        <button type="submit" class="btn btn-primary mt-3">{{ isset($direction->id) ? 'Enregistrer' : 'Enregistrer' }}</button>
    </form>
</div>
@endsection
