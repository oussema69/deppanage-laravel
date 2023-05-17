@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-primary bg-primary mb-3" style="margin-top: -1px;margin-left:1%;background-color: #4f44c7 !important;" >
    <a class="navbar-brand"><span class='text-center' style="color:aliceblue;margin-left:70px"><i class="fas fa-tachometer-alt fa-fw me-3"></i>Dashboard</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


</nav>
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Clients</p>
                            <h4 class="my-1 text-info">{{ $totalClients }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Voitures</p>
                            <h4 class="my-1 text-info">{{ $totalCars }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="fa fa-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Camion </p>
                            <h4 class="my-1 text-info"> {{ $totalCamionRemourquage }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fa fa-bar-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Chauffeurs</p>
                            <h4 class="my-1 text-info">{{ $totalChauffeurs }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col" style="width: 100%;">
            <div class="card radius-10">
                <div class="card-body">
                    <canvas id="requestChart"></canvas>
                </div>
            </div>
        </div>




    </div>
</div>
<style>
    #requestChart {
        width: 100%;
        height: 350px;
        /* Adjust the height as needed */
        margin-top: 20px;
    }

    ,

</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        var processed = {{ $demande}};
        var pending = {{ $demandeNon }};
        var ctx = document.getElementById('requestChart').getContext('2d');
        var requestChart = new Chart(ctx, {
            type: 'pie'
            , data: {
                labels: ['Demande Traité', 'Demande non Traités']
                , datasets: [{
                    data: [processed, pending]
                    , backgroundColor: ['#4f44c7', '#F74F66']
                    , borderWidth: 0
                }]
            }
            , options: {
                responsive: true
                , maintainAspectRatio: false
                , legend: {
                    position: 'bottom'
                }
            }
        });



    });;

</script>
@endsection
