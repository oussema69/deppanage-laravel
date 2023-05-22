@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-primary bg-primary mb-3" style="margin-top: 0px;margin-left:1%;background-color: #4f44c7 !important;">
    <a class="navbar-brand" ><span class='text-center' style="color:aliceblue;margin-left:70px"><i class="fa-solid fa-users"></i>Demandes Non Traité</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="col-md-6" style="margin-left:160px">
        <form action="{{ route('demandes.search') }}" method="GET" class="d-flex justify-content-end">
          <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Rechercher...">
            <button type="submit" class="btn btn-secondary ml-2"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>

  </nav>
  <?php
  if (isset($_SESSION['error_message'])) {
    $errorMessage = $_SESSION['error_message'];
    echo "Error: " . $errorMessage;
    unset($_SESSION['error_message']); // Clear the error message from the session
}
?>
  <div class="container" >

    <table class="table table-striped">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Date</th>
                <th>Type de véhicule</th>
                <th>Nombre de personnes</th>
                <th>tel</th>
                <th>Client</th>
                <th>Voiture</th>
                <th>Chauffeur</th>
                <th>Actions</th>


            </tr>
        </thead>
        <tbody>
            @foreach($demandes as $demande)
            <tr>
                    <td>{{ $demande->id }}</td>
                    <td>{{ $demande->nom }}</td>
                    <td>{{ $demande->date }}</td>
                    <td>{{ $demande->type_veh }}</td>
                    <td>{{ $demande->nbr_personne }}</td>
                    <td>{{ $demande->nbr_personne }}</td>
                    <td>{{ $demande->client->nom }}</td>
                    <td>{{ $demande->car ? $demande->car->marque .' '. $demande->car->modele .' ('. $demande->car->matricule .')' : '-' }}</td>
                    <td>{{ $demande->chauffeur ? $demande->chauffeur->nom .' '. $demande->chauffeur->prenom .' ('. $demande->chauffeur->tel .')' : '-' }}</td>
                    <td>

                        <form  method="POST" action="{{ route('demandes.destroy', $demande->id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this demande?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
                        </form>
                        @if ($demande->chauffeur === null)

                        <a href="{{ route('chauffeurs.with-condition', $demande->id) }}" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">affecter</a>
                        @endif
                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>
    @if(isset($search))
    <div class="text-center">
        <a href="{{ route('demandes.index') }}" class="btn btn-secondary"><i class="fa-sharp fa-solid fa-arrow-left"></i></a>
    </div>
    @endif


@endsection
