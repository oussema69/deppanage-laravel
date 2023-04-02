@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a new truck</h1>

        <form action="{{ route('trucks.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="matricule">Matricule:</label>
                <input type="text" class="form-control" name="matricule" id="matricule" required>
                @if($errors->has('matricule'))
        <div class="text-danger">{{ $errors->first('matricule') }}</div>
    @endif
            </div>

            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" name="model" id="model" required>
            </div>

            <div class="form-group">
                <label for="etat">Etat:</label>
                <input type="text" class="form-control" name="etat" id="etat" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
