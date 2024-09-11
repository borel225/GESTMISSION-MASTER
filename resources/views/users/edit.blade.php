@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-3 mt-3">Modifier l'utilisateur</h1>
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="form-text text-muted">Laissez vide pour conserver le mot de passe actuel.</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmation du mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label for="mappage">Mappage</label>
                    <input type="text" name="mappage" id="mappage" class="form-control" value="{{ old('mappage', $user->mappage) }}">
                </div>

                <div class="form-group">
                    <label>Rôles</label>
                    @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}" class="form-check-input"
                                {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                            <label for="role_{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="d-grid gad-2">
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
                </div>
            </form>
            </div>
        </div>

</div>
@endsection
