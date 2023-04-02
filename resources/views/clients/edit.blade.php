@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class='text-center'>Edit Client</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <form method="POST" action="{{ route('clients.update', $client->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $client->nom }}" required>
            @error('nom')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" class="form-control" value="{{ $client->prenom }}" required>
            @error('prenom')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $client->email }}" required>
            @error('email')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="matricule">Matricule</label>
            <input type="text" name="matricule" class="form-control" value="{{ $client->matricule }}" required>
 @error('matricule')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
        </div>
        <div class="form-group">
            <label for="num_assurance">Numéro assurance</label>
            <input type="number" name="num_assurance" class="form-control" value="{{ $client->num_assurance }}" required>
        @error('num_assurance')
        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group">
            <label for="tel">Téléphone</label>
            <input type="number" name="tel" class="form-control" value="{{ $client->tel }}" required>
            @error('tel')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success " style="margin-left:43%;width:10%" ><i class="fa-sharp fa-solid fa-pencil"></i>Update</button>
    </form>
</div>
@endsection
