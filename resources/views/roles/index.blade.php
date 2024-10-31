@extends('layouts.app')

@section('content')

<div class="container">

    <H1>liste des roles</H1>
    <a href="{{ route('roles.create') }}" class="btn btn-primary">Créer un role</a>


    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @foreach($role->permissions as $permission)
                            <span class="badge bg-primary">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Modifier</a>
                        <a href="{{ route('roles.permissions.edit', $role) }}" class="btn btn-info">Ajouter une Permission</a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
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

