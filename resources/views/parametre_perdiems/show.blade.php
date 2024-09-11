@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1>Paramètre Perdiem</h1>

            <div class="form-group">
                <label for="type_mission_id">Type de Mission</label>
                <select id="type_mission_id" class="form-control">
                    <option value="">Choisir un type de mission</option>
                    @foreach ($typesMissions as $typeMission)
                        <option value="{{ $typeMission->id }}">{{ $typeMission->libelle }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="categorie_agent_id">Catégorie d'Agent</label>
                <select id="categorie_agent_id" class="form-control">
                    <option value="">Choisir une catégorie d'agent</option>
                </select>
            </div>

            <div class="form-group">
                <label for="montant">Montant</label>
                <input type="text" id="montant" class="form-control" readonly>
            </div>
    </div>
</div>



@endsection
