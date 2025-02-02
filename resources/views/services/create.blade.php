@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Créer un service</h1>
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="libelle">Nom du service</label>
                    <input type="text" name="libelle" id="libelle" class="form-control" required>
                </div>
                <label for="direction_id" class="form-label">Direction</label>
                    <select name="direction_id" id="direction_id" class="form-control">
                        @foreach ($directions as $direction)
                            <option value="{{ $direction->id }}">{{ $direction->libelle }}</option>
                        @endforeach
                    </select>

                <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
            </div>
        </div>
    </form>
</div>

@endsection
