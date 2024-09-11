@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1>Ajouter un Paramètre Perdiem</h1>

    <form action="{{ route('parametre_perdiems.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="type_mission_id">Type de Mission</label>
            <select name="type_mission_id" id="type_mission_id" class="form-control" required>
                <option value="">Choisir un type de mission</option>
                @foreach ($typesMissions as $typeMission)
                    <option value="{{ $typeMission->id }}">{{ $typeMission->libelle }}</option>
                @endforeach
            </select>
            @error('type_mission_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categorie_agent_id">Catégorie d'Agent</label>
            <select name="categorie_agent_id" id="categorie_agent_id" class="form-control" required>
                <option value="">Choisir une catégorie d'agent</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                @endforeach
            </select>
            @error('categorie_agent_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="montant">Montant</label>
            <input type="number" name="montant" id="montant" class="form-control" step="0.01" min="0" required>
            @error('montant')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
    </form>
        </div>
    </div>
</div>

@endsection
