<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Add this import statement

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve statistics for Clients table
        $totalClients = DB::table('clients')->count();
    
        // Retrieve statistics for Cars table
        $totalCars = DB::table('cars')->count();
    
        // Retrieve statistics for Camion_Remourquage table
        $totalCamionRemourquage = DB::table('camion_remourquage')->count();
    
        // Retrieve statistics for Chauffeurs table
        $totalChauffeurs = DB::table('chauffeurs')->count();
        $totaldep = DB::table('camion_remourquage_car')->count();
        $demandeTraite = DB::table('demandes')->where('isValid', true)->count();
        $demandeNonTrait = DB::table('demandes')->where('isValid', false)->count();
    
    
        // Pass all the retrieved statistics to the dashboard view
        return view('dashboard')
            ->with('totalClients', $totalClients)
            ->with('totalCars', $totalCars)
            ->with('totalCamionRemourquage', $totalCamionRemourquage)
            ->with('totaldep', $totaldep)
            ->with('totalChauffeurs', $totalChauffeurs)
            ->with('demandeNon',$demandeNonTrait )
            ->with('demande',$demandeTraite );

    }
    
}
