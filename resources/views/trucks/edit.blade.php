@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center text-primary">Modifier Camion</h1>
                <form action="{{ route('trucks.update', ['truck' => $truck->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="matricule">Matricule</label>
                        <input type="text" class="form-control" id="matricule" name="matricule" value="{{ $truck->matricule }}">
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" value="{{ $truck->model }}">
                    </div>
                    <div class="form-group">
                        <label for="etat">Etat</label>
                        <select class="form-control" id="etat" name="etat">
                            <option value="non disponible" {{ $truck->etat == 'non disponible' ? 'selected' : '' }}>Non Disponible</option>
                            <option value="disponible" {{ $truck->etat == 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="panne" {{ $truck->etat == 'panne' ? 'selected' : '' }}>Panne</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <div id="message"></div>
                    @if(session('message'))
                    <div class="alert alert-success" role="alert" id="success-message">
                        {{ session('message') }}
                    </div>
                @endif

                <script>
                    // Hide success message after 10 seconds
                    setTimeout(function() {
                        var successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                    }, 3000);
                </script>


                </form>
            </div>
        </div>
    </div>
@endsection

