@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class='text-center text-primary'><i
                    class="fas fa-users fa-fw me-3"></i>Cars List for {{ $client->nom }} {{ $client->prenom }}</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Marque</th>
                            <th>Modele</th>
                            <th>Matricule</th>
                            <th>Numéro d'assurance</th>
                            <th>Date payment assurance</th>
                            <th>Date fin assurance</th>
                            <th>Actions</th>
                            <th>View Trucks</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($cars))
                            @foreach ($cars as $car)
                                <tr>
                                    <td>{{ $car->marque }}</td>
                                    <td>{{ $car->modele }}</td>
                                    <td>{{ $car->matricule }}</td>
                                    <td>{{ $car->num_assurance }}</td>
                                    <td>{{ $car->date_payment_assurance }}</td>
                                    <td>{{ $car->date_fin }}</td>
                                    <td>
                                        <a href="{{ route('cars.show', ['car' => $car->id]) }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-car"></i></a>

                                        <a href="{{ route('cars.edit', ['car' => $car->id]) }}" class="btn btn-success"><i class="fa-sharp fa-solid fa-pencil"></i></a>

                                        <form action="{{ route('cars.destroy', ['car' => $car->id]) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this car?')"><i
                                                    class="fa-sharp fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('cars.trucks', ['car' => $car->id]) }}" class="btn btn-info"><i class="fa-sharp fa-solid fa-truck"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ route('cars.create', ['client' => $client->id]) }}" class="btn btn-primary mb-3">Add New Car</a>

    </div>
@endsection
