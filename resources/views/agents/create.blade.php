@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <h3 class="text-center mb-3 mt-3">Créer un agent</h3>
            <form action="{{ route('agents.store') }}" method="POST">
                @csrf

                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" required>

                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" required>

                    <label for="matricule" class="form-label">Matricule</label>
                    <input type="text" name="matricule" id="matricule" class="form-control" required>

                    <label for="service_id" class="form-label">Service</label>
                    <select name="service_id" id="service_id" class="form-control">
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->libelle }}</option>
                        @endforeach
                    </select>

                    <label for="fonction_id" class="form-label">Fonction</label>
                    <select name="fonction_id" id="fonction_id" class="form-control">
                        @foreach ($fonctions as $fonction)
                            <option value="{{ $fonction->id }}">{{ $fonction->libelle }}</option>
                        @endforeach
                    </select>

                    <label for="categorie_agent_id" class="form-label">Choisir la catégorie de l'agent</label>
                    <select name="categorie_agent_id" id="categorie_agent_id" class="form-control">
                        <option value="">Aucune catégorie</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                        @endforeach
                    </select>

                    <label for="superieur_id" class="form-label">Supérieur Hiérarchique </label>
                    <select name="superieur_id" id="superieur_id" class="form-control">
                        <option value="">Aucun supérieur</option>
                        @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }}</option>
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
