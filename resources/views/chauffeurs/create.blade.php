@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('chauffeurs.store') }}">
    @csrf
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" id="nom"  required>
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" id="prenom"  required>
        @error('prenom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"  required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="tel">Téléphone</label>
        <input type="number" name="tel" class="form-control @error('tel') is-invalid @enderror" id="tel"  required>
        @error('tel')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="condition">Condition</label>
        <input type="text" name="condition" class="form-control @error('condition') is-invalid @enderror" id="condition"  required>
        @error('condition')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="camion_remourquage_id">Camion Remaurquage</label>
        <select name="camion_remourquage_id" class="form-control @error('camion_remourquage_id') is-invalid @enderror" id="camion_remourquage_id" required>
            <option value="">Select a Camion Remaurquage</option>
            @foreach ($camions as $camion)
                @if (!$camion->chauffeur)
                    <option value="{{ $camion->id }}" @if (old('camion_remourquage_id') == $camion->id) selected @endif>{{ $camion->matricule }}</option>
                @endif
            @endforeach
        </select>
        @error('camion_remourquage_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

@endsection