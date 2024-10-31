@extends('layouts.app')


@section('content')

<div class="container">
    <h1>Liste des permissions</h1>
    <a href="{{ route('permissions.create')}}" class="btn btn-primary">Créer une permission</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <td>Nom</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission )
            <tr>
                <td>{{$permission->name}}</td>
                <td>
                    <a href="{{ route('permissions.edit', $permission->id)}}" class="btn btn-warning">Modifier</a>
                    <form action="{{route('permissions.destroy', $permission->id)}}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

@endsection
