@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <h3 class="text-center mb-3 mt-3">Modifier un agent</h3>
        <form action="{{ route('agents.update', $agent->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $agent->nom) }}" required>

                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $agent->prenom) }}" required>

                            <label for="matricule" class="form-label">Matricule</label>
                            <input type="text" name="matricule" id="matricule" class="form-control" value="{{ old('matricule', $agent->matricule) }}" required>

                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $agent->email) }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <label for="service_id" class="form-label">Service</label>
                            <select id="service_id" name="service_id" class="form-control" required onchange="updateDirections()">
                                <option value="">Sélectionnez un service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" {{ $agent->service_id == $service->id ? 'selected' : '' }}>
                                        {{ $service->libelle }}
                                    </option>
                                @endforeach
                            </select>

                            <label for="direction_id" class="form-label">Direction</label>
                            <select id="direction_id" name="direction_id" class="form-control" required>
                                <option value="">Sélectionnez une direction</option>
                                @if ($agent->service->direction)
                                    <option value="{{ $agent->service->direction->id }}" selected>
                                        {{ $agent->service->direction->libelle }}
                                    </option>
                                @endif
                            </select>

                            <label for="fonction_id" class="form-label">Fonction</label>
                            <select name="fonction_id" id="fonction_id" class="form-control">
                                @foreach ($fonctions as $fonction)
                                    <option value="{{ $fonction->id }}" {{ $agent->fonction_id == $fonction->id ? 'selected' : '' }}>
                                        {{ $fonction->libelle }}
                                    </option>
                                @endforeach
                            </select>

                            <label for="categorie_agent_id" class="form-label">Choisir la catégorie de l'agent</label>
                            <select name="categorie_agent_id" id="categorie_agent_id" class="form-control">
                                <option value="">Aucune catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ $agent->categorie_agent_id == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->libelle }}
                                    </option>
                                @endforeach
                            </select>

                            <label for="superieur_id" class="form-label">Supérieur Hiérarchique </label>
                            <select name="superieur_id" id="superieur_id" class="form-control">
                                <option value="">Aucun supérieur</option>
                                @foreach ($agents as $superieur)
                                    <option value="{{ $superieur->id }}" {{ $agent->superieur_id == $superieur->id ? 'selected' : '' }}>
                                        {{ $superieur->nom }} {{ $superieur->prenom }} --- {{ $superieur->fonction->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
                </div>
            </form>
        </div>

    </div>

    <script>
        const services = @json($services);

        function updateDirections() {
            const serviceId = document.getElementById('service_id').value;
            const directionSelect = document.getElementById('direction_id');

            // Vider les directions
            directionSelect.innerHTML = '<option value="">Sélectionnez une direction</option>';

            if (serviceId) {
                const service = services.find(s => s.id == serviceId);
                if (service && service.direction) {
                    // Ajouter la direction liée au service
                    const option = document.createElement('option');
                    option.value = service.direction.id;
                    option.text = service.direction.libelle; // Assurez-vous d'utiliser le bon attribut pour le libellé
                    directionSelect.appendChild(option);
                }
            }
        }
    </script>
@endsection
