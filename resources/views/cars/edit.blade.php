@extends('layouts.app')

@section('content')
    <div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-primary text-center"><i
                    class="fas fa-pencil fa-fw me-3"></i>Edit Car Details</h1>
                <form action="{{ route('cars.update', ['car' => $car->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="marque">Marque</label>
                        <input type="text" class="form-control @error('marque') is-invalid @enderror" id="marque" name="marque" value="{{ $car->marque }}" required>
                        @error('marque')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="modele">Modele</label>
                        <input type="text" class="form-control @error('modele') is-invalid @enderror" id="modele" name="modele" value="{{ $car->modele }}" required>
                    @error('modele')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    </div>
                    <div class="form-group">
                        <label for="matricule">Matricule</label>
                        <input type="text" class="form-control @error('matricule') is-invalid @enderror" id="matricule" name="matricule" value="{{ $car->matricule }}" required>
                        @error('matricule')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="Num_assurance">Num Assurance</label>
                        <input type="text" class="form-control @error('num_assurance') is-invalid @enderror" id="num_assurance" name="num_assurance" value="{{ $car->num_assurance }}" required>
                        @error('num_assurance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    </div>
                    <div class="form-group">
                        <label for="date_payment_assurance">Date Paiement Assurance</label>
                        <input type="date" class="form-control @error('date_fin') is-invalid @enderror" id="date_payment_assurance" name="date_payment_assurance" value="{{ $car->date_payment_assurance }}" required>
                        @error('date_payment_assurance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="date_fin">Date Fin Assurance</label>
                        <input type="date"  class="form-control @error('date_fin') is-invalid @enderror" id="date_fin" name="date_fin" value="{{ $car->date_fin }}" required>
                        @error('date_fin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
