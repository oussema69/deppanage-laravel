<!-- trucks/cars.blade.php -->

@extends('layouts.app')

@section('content')
    <h1 class="text-center text-primary">Depanned Cars by {{ $truck->matricule }}</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Matricule</th>
                <th>Numéro d'assurance</th>
                <th>Date de paiement de l'assurance</th>
                <th>Date de fin de l'assurance</th>
                <th>Actions</th>
                <th>Owner</th>

            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
            <tr>
                <td>{{ $car->marque }}</td>
                <td>{{ $car->modele }}</td>
                <td>{{ $car->matricule }}</td>
                <td>{{ $car->num_assurance }}</td>
                <td>{{ $car->date_payment_assurance }}</td>
                <td>{{ $car->date_fin }}</td>
                <td style="width: 200px">
                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-car"></i></a>

                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-success"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this cars?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
                    </form>
                    
                </td>
                <td>
                    <a href="{{ route('cars.clients.show', $car->id) }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-user"></i></a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
