@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-primary text-center">{{ $car->marque }} {{ $car->modele }}</h1>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Marque:</td>
                            <td>{{ $car->marque }}</td>
                        </tr>
                        <tr>
                            <td>Modele:</td>
                            <td>{{ $car->modele }}</td>
                        </tr>
                        <tr>
                            <td>Matricule:</td>
                            <td>{{ $car->matricule }}</td>
                        </tr>
                        <tr>
                            <td>Num Assurance:</td>
                            <td>{{ $car->num_assurance }}</td>
                        </tr>
                        <tr>
                            <td>Date Paiement Assurance:</td>
                            <td>{{ $car->date_payment_assurance }}</td>
                        </tr>
                        <tr>
                            <td>Date Fin:</td>
                            <td>{{ $car->date_fin }}</td>
                        </tr>
                        <tr>
                            <td>propriétaire:</td>
                            <td>{{ $car->client->nom }} {{ $car->client->prenom }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('cars.edit', ['car' => $car->id]) }}" class="btn btn-success"><i
                        class="fa-sharp fa-solid fa-pencil"></i> Modifier</a>
                <form action="{{ route('cars.destroy', ['car' => $car->id]) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Vous Voulez supprimer cet voiture?')"><i class="fa-sharp fa-solid fa-trash"></i> Supprimer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
