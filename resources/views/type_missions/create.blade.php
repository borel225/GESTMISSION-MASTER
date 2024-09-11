@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{ route('type_missions.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                    <label for="libelle" class="form-label">Nom de missions :</label>
                    <input type="text" id="libelle" name="libelle" value="{{ old('libelle') }}" class="form-control" required>
                    @error('libelle')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
                <a href="{{ route('type_missions.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
            </div>
        </div>
    </form>
</div>

@endsection
