<!-- chauffeurs/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Chauffeur Details</h1>
        <h5 class="card-title"> </h5>

        <table class="table table-striped">
            <tbody>
                <tr>

                    <th>Nom:</th>
                    <td>{{ $chauffeur->nom }}</td>
                </tr>
                <tr>

                    <th>Prenom:</th>
                    <td>{{ $chauffeur->prenom }}</td>
                </tr>
                <tr>
                    <th>Telephone::</th>
                    <td>{{ $chauffeur->tel }}</td>
                </tr>
                <tr>
                    <th>Email::</th>
                    <td>{{ $chauffeur->email }}</td>
                </tr>
                <tr>
                    <th>Condition:</th>
                    <td>{{ $chauffeur->condition }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('chauffeurs.edit', $chauffeur->id) }}" class="btn btn-primary">Edit</a>

        <form action="{{ route('chauffeurs.destroy', $chauffeur->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Driver?')">Delete</button>
        </form>
    
        <a href="{{ route('chauffeurs.showCamion', $chauffeur->id) }}" class="btn btn-secondary">Camion</a>
    
    
@endsection



