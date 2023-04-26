@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-primary bg-primary mb-3" style="margin-top: -38px">
    <a class="navbar-brand" ><span class='text-center' style="color:aliceblue;margin-left:70px"><i class="fas fa-tachometer-alt fa-fw me-3"></i>Dashboard</span></a>
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
            <div class="card radius-10 border-start border-0 border-3 border-danger">
               <div class="card-body">
                   <div class="d-flex align-items-center">
                       <div>
                           <p class="mb-0 text-secondary">Total Cars</p>
                           <h4 class="my-1 text-danger">{{$totalCars}}</h4>
                       </div>
                       <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="fa fa-dollar"></i>
                       </div>
                   </div>
               </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-success">
               <div class="card-body">
                   <div class="d-flex align-items-center">
                       <div>
                           <p class="mb-0 text-secondary">Total Camion </p>
                           <h4 class="my-1 text-success"> {{ $totalCamionRemourquage }}</h4>
                       </div>
                       <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fa fa-bar-chart"></i>
                       </div>
                   </div>
               </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
               <div class="card-body">
                   <div class="d-flex align-items-center">
                       <div>
                           <p class="mb-0 text-secondary">Total Chauffeurs</p>
                           <h4 class="my-1 text-warning">{{ $totalChauffeurs }}</h4>
                       </div>
                       <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
                       </div>
                   </div>
               </div>
            </div>
          </div> 
          <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
               <div class="card-body">
                   <div class="d-flex align-items-center">
                       <div>
                           <p class="mb-0 text-secondary">Total deppanage operation</p>
                           <h4 class="my-1 text-warning">{{ $totaldep }}</h4>
                       </div>
                       <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
                       </div>
                   </div>
               </div>
            </div>
          </div> 
        </div>
    </div>
@endsection