@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <h1 class="text-center mb-3 mt-3">Créer une mission</h1>
        <form action="{{ route('missions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <label for="libelle" class="form-label">Intitulé de la mission</label>
                                    <input type="text" name="libelle" id="libelle" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="objectif" class="form-label">Objectif de la mission</label>
                                    <input type="text" name="objectif" id="objectif" class="form-control" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="date_depart" class="form-label">Date de départ</label>
                                        <input type="date" name="date_depart" id="date_depart" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="date_retour" class="form-label">Date de Retour</label>
                                        <input type="date" name="date_retour" id="date_retour" class="form-control" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="interet" class="form-label">Intérêt de la mission</label>
                                    <input type="text" name="interet" id="interet" class="form-control" required>
                                </div>

                                <label for="tdr" class="from-label">TDR</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="tdr" id="tdr">

                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="destination_depart_id" class="form-label">Destination de départ</label>
                                        <select name="destination_depart_id" id="destination_depart_id" class="form-control" required>
                                            @foreach ($lieus as $lieu)
                                                <option value="{{ $lieu->id }}">{{ $lieu->libelle }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="destination_arrivee_id" class="form-label">Destination d'arrivée</label>
                                        <select name="destination_arrivee_id" id="destination_arrivee_id" class="form-control" required>
                                            @foreach ($lieus as $lieu)
                                                <option value="{{ $lieu->id }}">{{ $lieu->libelle }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="observation" class="form-label">Observations</label>
                                    <textarea class="form-control" id="observation" name="observation" rows="3"></textarea>
                                </div>
                                <input type="hidden" id="participants" name="participants">
                            </div>
                        </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type_mission_id">Type de Mission</label>
                            <select name="type_mission_id" id="type_mission_id" class="form-control">
                                @foreach($typesMissions as $type)
                                    <option value="{{ $type->id }}" {{ old('type_mission_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="distance" class="form-label">Distance (Km)</label>
                        <input type="number" name="distance" id="distance" class="form-control" required>
                    </div>
                        <div class="form-group">
                            <div class="d-grid gap-2 col-6  mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agentsModal">Ajouter des participants</button>
                            </div>
                            <ul id="participantsList" class="list-group mt-2"></ul>
                        </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal pour la sélection des agents -->
<div class="modal fade" id="agentsModal" tabindex="-1" aria-labelledby="agentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="agentsModalLabel">Ajouter des participants</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-check">
                @foreach($agents as $agent)
                    <input class="form-check-input" type="checkbox" id="agent{{ $agent->id }}" value="{{ $agent->id }}">
                    <label class="form-check-label" for="agent{{ $agent->id }}">
                        {{ $agent->nom }}  {{ $agent->prenom }}
                    </label>
                    <br>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-primary" id="saveAgents">Insérer</button>
        </div>
      </div>
    </div>
  </div>

@endsection



