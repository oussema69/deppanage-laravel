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
            'car_id' => 'nullable|exists:cars,id',
            'isValid' => 'nullable|boolean',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'device_token' => 'required|string',
        ]);
        $carId = $validatedData['car_id'];

        // Check the length of related CamionRemourquageCar instances for the given car_id
        $camionRemourquageCarsCount = CamionRemourquageCar::where('car_id', $carId)->count();

        // If the count is greater than or equal to 3, return an error message
        if ($camionRemourquageCarsCount >= 3) {
            return response()->json([
                'message' => 'Cannot create demande.you have maximum 3 demandes for car.'
            ], 422);
        } else {
            $demande = new Demande($validatedData);
            $demande->save();

            return response()->json([
                'message' => 'Demande created successfully',
                'demande' => $demande
            ]);
        }
    }

    public function sendNotif($token)
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->post('https://fcm.googleapis.com/fcm/send', [
                'headers' => [
                    'Authorization' => 'key=AAAAGYS-2So:APA91bFOeNV4ltieYQ7FT5EYBwbUJLpcLeLFvNfiODekvvlg7DaI1SSmjMeMXn4Mh6gfCbUV9IBtcm04tz8kqFNG2-RYDSP76KgImYgLHgusBk87X8C0t3sLGe2exC_fj-dtbgXsNPWI',
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'to' => $token,
                    'notification' => [
                        'title' => 'nouvelle demande',
                        'body' => 'vous avez une nouvelle demande tel:'
                    ]
                ]
            ]);

            $body = $response->getBody();
            echo $body;
        } catch (\Exception $e) {
            // Save error message in session

            $_SESSION['error_message'] = $e->getMessage();
            return;
        }
    }

    public function sendNotiftoClient($token,$tel)
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->post('https://fcm.googleapis.com/fcm/send', [
                'headers' => [
                    'Authorization' => 'key=AAAAGYS-2So:APA91bFOeNV4ltieYQ7FT5EYBwbUJLpcLeLFvNfiODekvvlg7DaI1SSmjMeMXn4Mh6gfCbUV9IBtcm04tz8kqFNG2-RYDSP76KgImYgLHgusBk87X8C0t3sLGe2exC_fj-dtbgXsNPWI',
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'to' => $token,
                    'notification' => [
                        'title' => 'nouvelle demande',
                        'body' => 'Votre demande est en cours de traitement avec le chauffeur de téléphone '.$tel.'.'
                        ]
                ]
            ]);

            $body = $response->getBody();
            echo $body;
        } catch (\Exception $e) {
            // Save error message in session

            $_SESSION['error_message'] = $e->getMessage();
            return;
        }
    }

    public function assignChauffeur($demande, $chauffeur_id)
    {

        // Retrieve the demande and chauffeur based on the $demande and $chauffeur_id parameters
        $demande = Demande::findOrFail($demande);
        $chauffeur = Chauffeur::findOrFail($chauffeur_id);
        $this->sendNotiftoClient($demande->device_token,$chauffeur->tel);
        $this->sendNotif($chauffeur->device_token);

        // Update the demande with the assigned chauffeur
        $demande->chauffeur_id = $chauffeur->id;
        $demande->save();
        $camionRemourquageCar = new CamionRemourquageCar();
        $camionRemourquageCar->camion_remourquage_id = $chauffeur->camion_remourquage_id;
        $camionRemourquageCar->car_id = $demande->car_id;
        $camionRemourquageCar->date = now()->format('Y-m-d H:i:s');

        $camionRemourquageCar->save();


        // Return a redirect with flashed message
        return redirect()->route('demandes.index')->with('message', 'Chauffeur assigned to demande successfully.');
    }







    public function index()
    {
        $demandes = Demande::notValid()->get();
        return view('demandes.index', compact('demandes'));
    }
    public function welcome()
    {
        return view('welcome');
    }
    public function traitedDemande()
    {
        $demandes = Demande::where('isValid', true)->get();
        return view('demandes.demande', compact('demandes'));
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

        return view('demandes.index', compact('demandes', 'search'));
    }
    public function getDemandesByRole($id, $type)
    {
        if ($type == 1) {
            $demandes = Demande::where('client_id', $id)->get();
        } else {
            $demandes = Demande::where('chauffeur_id', $id)->get();
        }
        return response()->json($demandes);
    }

    public function apiUpdateIsValid($id)
    {
        // Find the demande with the given id
        $demande = Demande::find($id);

        // If demande does not exist, return an error message
        if (!$demande) {
            return response()->json([
                'message' => 'Demande not found'
            ], 404);
        }

        // Set isValid attribute to true
        $demande->isValid = true;

        // Save changes to the database
        $demande->save();

        // Return success response
        return response()->json([
            'message' => 'Demande isValid attribute updated successfully',
            'demande' => $demande
        ]);
    }
}
