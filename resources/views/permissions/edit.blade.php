@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier une permission</h1>
        <form action="{{ route('permissions.update', $permission->id)}}" method="POST" >
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <label for="name" class="form-label">Nom de la permission </label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$permission->name}}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
        </form>
    </div>
@endsection
