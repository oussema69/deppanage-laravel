<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Chauffeur;
use App\Models\CamionRemourquageCar;
use App\Models\CamionRemourquage;



use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function apiCreate(Request $request)
    {
        $validatedData = $request->validate([
            'nbr_personne' => 'required|integer',
            'type_veh' => 'required|string',
            'nom' => 'required|string',
            'date' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'chauffeur_id' => 'nullable|exists:chauffeurs,id',
            'car_id' => 'nullable|exists:cars,id'
        ]);

        $demande = new Demande($validatedData);
        $demande->save();

        return response()->json([
            'message' => 'Demande created successfully',
            'demande' => $demande
        ]);
    }

    public function assignChauffeur(Request $request, Demande $demande, Chauffeur $chauffeur)
    {
        $demande->chauffeur_id = $chauffeur->id;
        $demande->save();
    
    
        $camionRemourquageCar = new CamionRemourquageCar();
        $camionRemourquageCar->camion_remourquage_id = $chauffeur->camion_remourquage_id; // use camionRemourquage_id from chauffeur
        $camionRemourquageCar->car_id = $demande->car_id;
        $camionRemourquageCar->save();
    
        return response()->json([
            'message' => 'Chauffeur assigned to demande successfully.'
        ]);
    }
    
    


}
