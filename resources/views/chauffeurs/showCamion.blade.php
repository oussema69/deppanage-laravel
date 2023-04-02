@extends('layouts.app')

@section('content')
    <h1>Camion de {{ $camion->model }}</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Modèle</th>
                <th>État</th>


            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $camion->matricule }}</td>
                <td>{{ $camion->model }}</td>
                <td>{{ $camion->etat }}</td>
            </tr>
       
        </tbody>
      
    </table>
    <a href="{{ route('trucks.edit', ['truck' => $camion->id]) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('trucks.destroy', ['truck' => $camion->id]) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this truck?')">Delete</button>
    </form>
@endsection
