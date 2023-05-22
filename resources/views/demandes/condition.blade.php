@extends('layouts.app')

@section('content')

<nav class="navbar navbar-expand-lg navbar-primary bg-primary mb-3" style="margin-top: -1px;margin-left:1%;background-color: #4f44c7 !important;">
    <a class="navbar-brand" ><span class='text-center' style="color:aliceblue;margin-left:70px"><i class="fa-solid fa-users"></i>Drivres List</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="col-md-6" style="margin-left:250px">
        <form action="{{ route('chauffeurs.index') }}" method="GET" class="d-flex justify-content-end">
          <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search...">
            <button type="submit" class="btn btn-secondary ml-2"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
      </div>

  </nav>
  <?php
  if (isset($_SESSION['error_message'])) {
    $errorMessage = $_SESSION['error_message'];
    echo "Error: " . $errorMessage;
    unset($_SESSION['error_message']); // Clear the error message from the session
}
?>
    <div class="container" style="margin-top: 50px">

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Condition</th>
                    <th>Actions</th>
                    <th>Truck</th>
                    <th>affectation</th>



                </tr>
            </thead>
            <tbody>
                @foreach($chauffeurs as $chauffeur)
                    <tr>
                        <td>{{ $chauffeur->id }}</td>
                        <td>{{ $chauffeur->nom }}</td>
                        <td>{{ $chauffeur->prenom }}</td>
                        <td>{{ $chauffeur->email }}</td>
                        <td>{{ $chauffeur->tel }}</td>
                        <td>{{ $chauffeur->condition }}</td>
                        <td>
                            <a href="{{ route('chauffeurs.show', $chauffeur->id) }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-eye"></i></a>
                            <a href="{{ route('chauffeurs.edit', $chauffeur->id) }}" class="btn btn-success"><i class="fa-sharp fa-solid fa-pencil"></i></a>


                            <form action="{{ route('chauffeurs.destroy', $chauffeur->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this driver?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                        <td>     <a href="{{ route('chauffeurs.showCamion', $chauffeur->camion_remourquage_id) }}" class="btn btn-info">
                            <i class="fa-sharp fa-solid fa-truck"></i>
                        </a></td>
                        <td>
                            <form action="{{ route('demandes.assign', ['demande' => request()->route('id'), 'chauffeur_id' => $chauffeur->id]) }}" method="post"  style="display: inline-block;">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success"><i class="fa-sharp fa-solid fa-check"></i></button>


                            </form>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        @if(isset($searchTerm))
        <div class="text-center">
            <a href="{{ route('chauffeurs.index') }}" class="btn btn-secondary"><i class="fa-sharp fa-solid fa-arrow-left"></i></a>
        </div>
        @endif

    </div>

@endsection
