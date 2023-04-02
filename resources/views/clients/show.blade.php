@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-primary text-center"> {{ $client->prenom }} {{ $client->nom }} Details</h1>
        <h5 class="card-title"> </h5>

        <table class="table table-striped">
            <tbody>
                <tr>
                    
                    <th>Email:</th>
                    <td>{{  $client->email }}</td>
                </tr>
                <tr>
                    
                    <th>Matricule:</th>
                    <td>{{ $client->matricule }}</td>
                </tr>
                <tr>
                    <th>Assurance:</th>
                    <td>{{ $client->num_assurance }}</td>
                </tr>
                <tr>
                    <th>Tel:</th>
                    <td>{{ $client->tel }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('clients.destroy', ['id' => $client->id]) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
        </form> 
@endsection
