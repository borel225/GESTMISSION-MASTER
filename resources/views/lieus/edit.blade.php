@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h1 class="text-center mb-3 mt-3">Modifier un lieu</h1>
            <form action="{{ route('lieus.update', $lieu) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="type_lieu">Type de Lieu</label>
                    <select name="type_lieu" id="type_lieu" class="form-control" required>
                        @foreach ($typelieu as $type)
                            <option value="{{ $type }}" {{ $lieu->type_lieu == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="parent_id">Parent</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="">Aucun</option>
                        @foreach ($lieus as $parent)
                            <option value="{{ $parent->id }}" {{ $lieu->parent_id == $parent->id ? 'selected' : '' }}>
                                {{ $parent->libelle }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="libelle">Libellé</label>
                    <input type="text" name="libelle" id="libelle" class="form-control" value="{{ old('libelle', $lieu->libelle) }}" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
