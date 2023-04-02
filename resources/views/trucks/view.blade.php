<!-- resources/views/trucks/view.blade.php -->

@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-primary bg-primary mb-3" style="margin-top: -38px">
    <a class="navbar-brand" href="#"><span class='text-center' style="color:aliceblue;margin-left:70px"><i class="fa-solid fa-users"></i>Trucks List</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="col-md-6" style="margin-left:250px">
        <form action="{{ route('camion.search') }}" method="GET" class="d-flex justify-content-end">
          <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search...">
            <button type="submit" class="btn btn-secondary ml-2"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
      </div>

  </nav>
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <div class="container mb-3">


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Model</th>
                            <th>Etat</th>
                            <th>Actions</th>
                            <th>Depanned Cars<th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trucks as $truck)
                        <tr>
                            <td>{{ $truck->matricule }}</td>
                            <td>{{ $truck->model }}</td>
                            <td>{{ $truck->etat }}</td>
                            <td>
                                <a  href="{{ route('trucks.show', $truck->id) }}"  class="btn btn-primary"><i class="fa-sharp fa-solid fa-eye"></i></a>
                                <a href="{{ route('trucks.edit', $truck->id) }}" class="btn btn-success"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                                <form action="{{ route('trucks.destroy', $truck->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this truck?')"><i class="fa-sharp fa-solid fa-trash"></i></button>
                                </form>
                           
                            </td>
                            <td>
                                <a  href="{{ route('trucks.cars', $truck->id) }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-car"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(isset($search))
                        <div class="text-center">
                            <a href="{{ route('trucks.view') }}" class="btn btn-secondary"><i class="fa-sharp fa-solid fa-arrow-left"></i></a>
                        </div>
                        @endif
            </div>
            <div class="container mb-3">
                <div class="row">
                  <div class="col-md-6">

                    <a href="{{ route('cam') }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-plus"></i>Create</a>
                  </div>

                </div>
              </div>
        </div>
    </div>
@endsection
