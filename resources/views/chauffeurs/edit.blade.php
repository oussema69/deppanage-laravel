@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Edit Chauffeur</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('chauffeurs.update', $chauffeur->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $chauffeur->nom) }}">
            </div>

            <div class="form-group">
                <label for="prenom">Prenom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $chauffeur->prenom) }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $chauffeur->email) }}">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="tel">Telephone:</label>
                <input type="text" class="form-control" id="tel" name="tel" value="{{ old('tel', $chauffeur->tel) }}">
            </div>

            <div class="form-group">
                <label for="condition">Condition:</label>
                <input type="text" class="form-control" id="condition" name="condition" value="{{ old('condition', $chauffeur->condition) }}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
