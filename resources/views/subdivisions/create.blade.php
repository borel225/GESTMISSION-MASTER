@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Créer une nouvelle subdivision</h1>
    <div class="row">
        <div class="col-md-4">

        <form action="{{ route('subdivisions.store') }}" method="POST">
            @csrf

            <div>
                <label for="libelle" class="form-label">Nom de la subdivision :</label>
                <input type="text" id="libelle" name="libelle" value="{{ old('libelle') }}" class="form-control" required>
                @error('libelle')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="parend_id" class="form-label">Subdivision parente :</label>
                <select id="parend_id" name="parend_id" class="form-control">
                    <option value="">Aucune</option>
                    @foreach ($subdivisions as $subdivision)
                        <option value="{{ $subdivision->id }}">{{ $subdivision->libelle }}</option>
                    @endforeach
                </select>
                @error('parend_id')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="chef_id" class="form-label">Chef :</label>
                <select id="chef_id" name="chef_id" class="form-control">
                    <option value="">Aucun</option>
                    @foreach ($agents as $agent)  <!-- Assurez-vous de passer la liste des agents à la vue -->
                        <option value="{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }}</option>
                    @endforeach
                </select>
                @error('chef_id')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Créer</button>
        </form>
    </div>
</div>

@endsection
