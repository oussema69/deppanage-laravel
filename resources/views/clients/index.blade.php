@extends('layouts.app')

@section('content')

<nav class="navbar navbar-expand-lg navbar-primary bg-primary mb-3" style="margin-top: -1px;margin-left:1%;background-color: #4f44c7 !important;">
    <a class="navbar-brand" href="#"><span class='text-center' style="color:aliceblue;margin-left:70px"><i class="fa-solid fa-users"></i>Liste Des Clients</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="col-md-6" style="margin-left:200px">
        <form action="{{ route('clients.index') }}" method="GET" class="d-flex justify-content-end">
          <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Rechercher...">
            <button type="submit" class="btn btn-secondary ml-2"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
      </div>

  </nav>
    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-md-12">
                <div class="container mb-3">


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                            <th>Matricule</th>
                            <th>Numéro d'assurance</th>
                            <th>Téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->nom }}</td>
                            <td>{{ $client->prenom }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->matricule }}</td>
                            <td>{{ $client->num_assurance }}</td>
                            <td>{{ $client->tel }}</td>
                            <td>

                                <a href="{{ route('clients.show', ['id' => $client->id]) }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-eye"></i></a>
                                <a href="{{ route('clients.edit', ['id' => $client->id]) }}" class="btn btn-success"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                                <form action="{{ route('clients.destroy', ['id' => $client->id]) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this client?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </form>


                                <a href="{{ route('clients.cars', ['id' => $client->id]) }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-car"></i></a>

                                @if (!$client->isValid)
        <form action="{{ route('clients.updateValidity', ['id' => $client->id]) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-secondary"><i class="fa-sharp fa-solid fa-lock"></i></button>
        </form>
    @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @if(isset($searchTerm))
                <div class="text-center">
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary"><i class="fa-sharp fa-solid fa-arrow-left"></i></a>
                </div>
                @endif
            </div>
            <div class="container mb-3">
                <div class="row">
                  <div class="col-md-6">
                    <a href="{{ route('clients.create') }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-plus"></i>Ajouter</a>
                  </div>

                </div>
              </div>
        </div>
    </div>

@endsection
