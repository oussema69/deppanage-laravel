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
                <h1 class="text-center">Add Car</h1>
                <form method="POST" action="{{ route('cars.store', ['client' => $client->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="marque">Marque</label>
                        <input type="text" class="form-control @if($errors->has('marque')) is-invalid @endif" id="marque" name="marque" value="{{ old('marque') }}" required>
                        @if($errors->has('marque'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('marque') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="modele">Modele</label>
                        <input type="text" class="form-control @error('modele') is-invalid @enderror" id="modele" name="modele" value="{{ old('modele') }}" required>
                        @error('modele')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="matricule">Matricule</label>
                        <input type="text" class="form-control @error('matricule') is-invalid @enderror" id="matricule" name="matricule" value="{{ old('matricule') }}" required>
                        @error('matricule')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="num_assurance">Numéro d'assurance</label>
                        <input type="text" class="form-control @error('num_assurance') is-invalid @enderror" id="num_assurance" name="num_assurance" value="{{ old('num_assurance') }}" required>
                        @error('num_assurance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date_payment_assurance">Date payment assurance</label>
                        <input type="date" class="form-control @error('date_payment_assurance') is-invalid @enderror" id="date_payment_assurance" name="date_payment_assurance" value="{{ old('date_payment_assurance') }}" required>
                        @error('date_payment_assurance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date_fin">Date fin assurance</label>
                        <input type="date" class="form-control @error('date_fin') is-invalid @enderror" id="date_fin" name="date_fin" value="{{ old('date_fin') }}" required>
                        @error('date_fin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('clients.show', ['id' => $client->id]) }}" class="btn btn-primary">View Details</a>
                </form>
                </div>
                </div>
                </div>
                @endsection
