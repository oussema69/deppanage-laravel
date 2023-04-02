@extends('layouts.app')

@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Matricule</th>
            <th>Téléphone</th>
            <th>Numéro d'assurance</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $car->client->nom }}</td>
            <td>{{ $car->client->prenom }}</td>
            <td>{{ $car->client->email }}</td>
            <td>{{ $car->client->matricule }}</td>
            <td>{{ $car->client->tel }}</td>
            <td>{{ $car->client->num_assurance }}</td>
            <td>
          
                <a href="{{ route('clients.edit', $car->client->id) }}" class="btn btn-success"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                <form  action="{{ route('clients.destroy', $car->client->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this client?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>
    </tbody>
</table>

@endsection
