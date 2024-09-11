@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Créer un role</h1>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Nom du role</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
    </form>
</div>

@endsection
