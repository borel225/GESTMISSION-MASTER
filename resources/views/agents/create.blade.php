@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
            <h3 class="text-center mb-3 mt-3">Créer un agent</h3>
            <form action="{{ route('agents.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control" required>

                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control" required>

                                <label for="matricule" class="form-label">Matricule</label>
                                <input type="text" name="matricule" id="matricule" class="form-control" required>

                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control" required>

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
                                <option value="{{ $service->id }}">{{ $service->libelle }}</option>
                            @endforeach
                        </select>

                        <label for="direction_id" class="form-label">Direction</label>
                        <select id="direction_id" name="direction_id" class="form-control" required>
                            <option value="">Sélectionnez une direction</option>
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
                            <option value="{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }} --- {{$agent->fonction->libelle }}</option>
                        @endforeach
                    </select>

                    {{-- <label for="subdivision_id" class="form-label">Nom de la subdivision </label>
                    <select name="subdivision_id" id="subdivision_id" class="form-control">
                        <option value="">Aucune subdivision</option>
                        @foreach ($subdivisions as $subdivision)
                            <option value="{{ $subdivision->id }}">{{ $subdivision->libelle }}</option>
                        @endforeach
                    </select> --}}
                    </div>
                </div>
                            </div>
                        </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
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
