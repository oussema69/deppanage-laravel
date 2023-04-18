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
            'tel' => 'required|integer',
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


    public function assignChauffeur(Request $request, $demande, $chauffeur_id)
    {
        // Retrieve the demande and chauffeur based on the $demande and $chauffeur_id parameters
        $demande = Demande::findOrFail($demande);
        $chauffeur = Chauffeur::findOrFail($chauffeur_id);
    
        // Update the demande with the assigned chauffeur
        $demande->chauffeur_id = $chauffeur->id;
        $demande->save();

        // Check if there is an existing CamionRemourquageCar entry with the same camion_remourquage_id and car_id
        $existingCamionRemourquageCar = CamionRemourquageCar::where('camion_remourquage_id', $chauffeur->camion_remourquage_id)
            ->where('car_id', $demande->car_id)
            ->first();
            
    
        if ($existingCamionRemourquageCar) {
            
            $existingCamionRemourquageCar->incrementOccurrence();
           // $existingCamionRemourquageCar->save();
        } else {
            // If no existing entry is found, create a new entry with occurrence set to 1
            $camionRemourquageCar = new CamionRemourquageCar();
            $camionRemourquageCar->camion_remourquage_id = $chauffeur->camion_remourquage_id;
            $camionRemourquageCar->car_id = $demande->car_id;
            $camionRemourquageCar->occurrence = 1;
            $camionRemourquageCar->save();
        }
    
        // Return a redirect with flashed message
        return redirect()->route('demandes.index')->with('message', 'Chauffeur assigned to demande successfully.');
    }
    
    
    
    
    
    
  public function index()
    {
        $demandes = Demande::all();
        return view('demandes.index', compact('demandes'));
    }
  public function destroy(Demande $demande)
    {
        $demande->delete();
        return redirect()->route('demandes.index')->with('success', 'Demande has been deleted successfully');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $demandes = Demande::where('nom', 'LIKE', '%' . $search . '%')
                        ->orWhere('nbr_personne', 'LIKE', '%' . $search . '%')
                        ->orWhere('type_veh', 'LIKE', '%' . $search . '%')
                        ->orWhere('date', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('client', function ($query) use ($search) {
                            $query->where('nom', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('chauffeur', function ($query) use ($search) {
                            $query->where('nom', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('car', function ($query) use ($search) {
                            $query->where('nom', 'LIKE', '%' . $search . '%');
                        })
                        ->get();

        return view('demandes.index', compact('demandes','search'));

    }















}
