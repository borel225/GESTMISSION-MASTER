@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une Permission au role : {{ $role->name }}</h1>

    <form action="{{ route('roles.permissions.update', $role) }}" method="POST">
        @csrf
        <div class="form-group">
            @foreach ($permissions as $permission)
                <div>
                    <input type="checkbox" name="permissions[]"  value="{{ $permission->name }}"
                    {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}>
                    <label class="label-form">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Ajouter </button>
    </form>
</div>
@endsection


