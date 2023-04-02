@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class='text-center text-primary' >Truck Details</h1>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            
                            <th>id</th>
                            <td>{{ $truck->id }}</td>
                        </tr>
                        <tr>
                            
                            <th>matricule</th>
                            <td>{{ $truck->matricule }}</td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td>{{ $truck->model }}</td>
                        </tr>
                        <tr>
                            <th>etat</th>
                            <td>{{ $truck->etat }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
