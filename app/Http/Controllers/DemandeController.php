<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Chauffeur;
use App\Models\CamionRemourquageCar;
use App\Models\Car;



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
        $carId = $validatedData['car_id'];

        // Check the length of related CamionRemourquageCar instances for the given car_id
        $camionRemourquageCarsCount = CamionRemourquageCar::where('car_id', $carId)->count();
    
        // If the count is greater than or equal to 3, return an error message
        if ($camionRemourquageCarsCount >= 3) {
            return response()->json([
                'message' => 'Cannot create demande.you have maximum 3 demandes for car.'
            ], 422);
        }else{
            $demande = new Demande($validatedData);
            $demande->save();
    
            return response()->json([
                'message' => 'Demande created successfully',
                'demande' => $demande
            ]);
        }
     
    }


    public function assignChauffeur( $demande, $chauffeur_id)
    {
        // Retrieve the demande and chauffeur based on the $demande and $chauffeur_id parameters
        $demande = Demande::findOrFail($demande);
        $chauffeur = Chauffeur::findOrFail($chauffeur_id);
    
        // Update the demande with the assigned chauffeur
        $demande->chauffeur_id = $chauffeur->id;
        $demande->save();
        $camionRemourquageCar = new CamionRemourquageCar();
        $camionRemourquageCar->camion_remourquage_id = $chauffeur->camion_remourquage_id;
        $camionRemourquageCar->car_id = $demande->car_id;
        $camionRemourquageCar->date =now()->format('Y-m-d H:i:s');

        $camionRemourquageCar->save();
        
    
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
