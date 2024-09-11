@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Modifier un role</h1>
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Nom du role</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
            </div>
        </div>
    </form>


@endsection
