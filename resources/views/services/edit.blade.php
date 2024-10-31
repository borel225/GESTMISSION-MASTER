@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Modifier le service</h1>
    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="libelle">Nom de la fonction</label>
                    <input type="text" name="libelle" id="libelle" class="form-control" value="{{ $service->libelle }}" required>
                </div>
                <div>
                    <label for="direction_id" class="label-form">Direction</label>
                    <select id="direction_id" name="direction_id" class="form-control" required>
                        @foreach ($directions as $direction)
                            <option value="{{ $direction->id }}" {{ $direction->id == $service->direction_id ? 'selected' : '' }}>
                                {{ $direction->libelle }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
            </div>
        </div>

    </form>
</div>

@endsection
