@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <h3 class="text-center mb-3 mt-3">Modifier l'agent</h3>
            <form action="{{ route('agents.update', $agent) }}" method="POST">
                @csrf
                @method('PUT')

                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ $agent->nom }}" required>

                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $agent->prenom }}" required>

                    <label for="matricule" class="form-label">Matricule</label>
                    <input type="text" name="matricule" id="matricule" class="form-control" value="{{ $agent->matricule }}" required>

                    <label for="service_id" class="form-label">Service</label>
                    <select name="service_id" id="service_id" class="form-control">
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ $agent->service_id == $service->id ? 'selected' : '' }}>{{ $service->libelle }}</option>
                        @endforeach
                    </select>

                    <label for="fonction_id" class="form-label">Fonction</label>
                    <select name="fonction_id" id="fonction_id" class="form-control">
                        @foreach ($fonctions as $fonction)
                            <option value="{{ $fonction->id }}" {{ $agent->fonction_id == $fonction->id ? 'selected' : '' }}>{{ $fonction->libelle }}</option>
                        @endforeach
                    </select>

                    <label for="categorie_agent_id" class="form-label">Choisir la catégorie de l'agent</label>
                    <select name="categorie_agent_id" id="categorie_agent_id" class="form-control">
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ $agent->categorie_agent_id == $categorie->id ? 'selected' : '' }}>{{ $categorie->libelle }}</option>
                        @endforeach
                    </select>

                    <label for="superieur_id" class="form-label">Supérieur Hiérarchique </label>
                    <select name="superieur_id" id="superieur_id" class="form-control">
                        <option value="">Aucun supérieur</option>
                        @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $agent->superieur_id == $agent->id ? 'selected' : '' }} >{{ $agent->nom }} {{ $agent->prenom }}</option>
                        @endforeach
                    </select>

                    <div class="d-grid gad-2">
                        <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
                    </div>

            </form>
        </div>
    </div>
</div>

@endsection
