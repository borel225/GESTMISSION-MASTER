@extends('layouts.app')

@section('content')

<div class="container">
    <h1>liste des villes</h1>
    <a href="{{ route('lieus.create') }}" class="btn btn-primary">Créer  un lieu</a>
    <div class="row">
        <div class="col-md-4">
         <table class="table m-3">
            <thead>
                <tr>
                    <th>nom du lieu </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lieus as $lieu)
                <tr>
                    <td>{{$lieu->libelle}}</td>
                    <td>
                        <a href="{{ route('lieus.edit', $lieu->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('lieus.destroy', $lieu->id) }}" method="POST" style="display:inline;">
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
    </div>
    </div>
</div>

@endsection
