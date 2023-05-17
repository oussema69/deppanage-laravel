<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Administrateur;

use App\Models\Chauffeur;
use App\Models\CamionRemourquage;

use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class ChauffeurController extends Controller
{
    public function index()
    {
        $chauffeurs = Chauffeur::all();
        return view('chauffeurs.index', compact('chauffeurs'));
    }


    public function create()
{
    $camions = CamionRemourquage::whereNotIn('id', function($query) {
        $query->select('camion_remourquage_id')
              ->from('chauffeurs');
    })->whereIn('etat', ['disponible', 'non disponible'])->orWhereNull('etat')->get();

    return view('chauffeurs.create', compact('camions'));
}
public function camionapi()
{
    $camions = CamionRemourquage::whereNotIn('id', function($query) {
        $query->select('camion_remourquage_id')
              ->from('chauffeurs');
    })->whereIn('etat', ['disponible', 'non disponible'])->orWhereNull('etat')->get();


    return response()->json([
        'camions' => $camions
    ]);
}




public function store(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:chauffeurs',
        'password' => 'required|string|min:8',
        'tel' => 'required|string|max:255',
        'condition' => 'required',


        'camion_remourquage_id' => 'required|exists:camion_remourquage,id',
    ]);



    $chauffeur = new Chauffeur;

    $chauffeur->nom = $validatedData['nom'];
    $chauffeur->prenom = $validatedData['prenom'];
    $chauffeur->email = $validatedData['email'];
    $chauffeur->password = Hash::make($validatedData['password']);
    $chauffeur->tel = $validatedData['tel'];
    $chauffeur->condition = $validatedData['condition'];

    $chauffeur->camion_remourquage_id = $validatedData['camion_remourquage_id'];
    $chauffeur->save();
    $token = $chauffeur->createToken('token-name')->plainTextToken;

    return redirect()->route('chauffeurs.index')->with('success', 'Chauffeur ajouté avec succès!');
}


public function storeapi(Request $request)
{
    try {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:chauffeurs',
            'password' => 'required|string|min:8',
            'tel' => 'required|string|max:255',
            'condition' => 'required',
            'camion_remourquage_id' => 'required|exists:camion_remourquage,id',
        ]);
    } catch (ValidationException $exception) {
        return response()->json([
            'message' => $exception->getMessage(),
            'errors' => $exception->validator->getMessageBag()
        ], 422);
    }

    $chauffeur = new Chauffeur;

    $chauffeur->nom = $validatedData['nom'];
    $chauffeur->prenom = $validatedData['prenom'];
    $chauffeur->email = $validatedData['email'];
    $chauffeur->password = Hash::make($validatedData['password']);
    $chauffeur->tel = $validatedData['tel'];
    $chauffeur->condition = $validatedData['condition'];

    $chauffeur->camion_remourquage_id = $validatedData['camion_remourquage_id'];
    $chauffeur->save();

    return response()->json([
        'message' => 'Chauffeur ajouté avec succès!',
        'chauffeur' => $chauffeur
    ], 201);
}




    public function show(Chauffeur $chauffeur)
    {
        return view('chauffeurs.show', compact('chauffeur'));
    }


    public function edit(Chauffeur $chauffeur)
{
    $camions = CamionRemourquage::whereNotIn('id', function($query) {
        $query->select('camion_remourquage_id')
              ->from('chauffeurs');
    })->whereIn('etat', ['disponible', 'non disponible'])->orWhereNull('etat')->get();

    return view('chauffeurs.edit', compact('chauffeur', 'camions'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required|email|unique:chauffeurs,email,'.$id,
        'password' => 'nullable',
        'tel' => 'required',
        'condition' => 'required',
        'camion_remourquage_id' => 'nullable|exists:camion_remourquage,id'
    ]);


    $chauffeur = Chauffeur::findOrFail($id);
    $chauffeur->nom = $request->nom;
    $chauffeur->prenom = $request->prenom;
    $chauffeur->email = $request->email;
    if (!empty($request->password)) {
        $chauffeur->password = Hash::make($request->password);
    }
    $chauffeur->tel = $request->tel;
    $chauffeur->condition = $request->condition;


    if (!empty($request->camion_remourquage_id)) {
        $chauffeur->camion_remourquage_id = $request->camion_remourquage_id;
    }


    $chauffeur->save();

    // Define or initialize $camions variable
    $camions = CamionRemourquage::whereNotIn('id', function($query) {
        $query->select('camion_remourquage_id')
              ->from('chauffeurs');
    })->whereIn('etat', ['disponible', 'non disponible'])->orWhereNull('etat')->get();

    return view('chauffeurs.edit', compact('chauffeur', 'camions'))->with('success', 'Chauffeur updated successfully');
}



    public function updateapi(Request $request, $id)
    {
        try {
            $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'email' => 'required|email|unique:chauffeurs,email,'.$id,
                'password' => 'required',
                'tel' => 'required|digits:8',
                'condition' => 'required',
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'errors' => $exception->validator->getMessageBag()
            ], 422);
        }

        $chauffeur = Chauffeur::find($id);
        $chauffeur->nom = $request->get('nom');
        $chauffeur->prenom = $request->get('prenom');
        $chauffeur->email = $request->get('email');
        $chauffeur->password = Hash::make($request->get('password'));
        $chauffeur->tel = $request->get('tel');
        $chauffeur->condition = $request->get('condition');

        $chauffeur->save();
        return response()->json([
            'message' => 'Chauffeur has been updated',
            'chauffeur' => $chauffeur
        ], 200);
    }




    public function destroy(Chauffeur $chauffeur)
    {
        $chauffeur->delete();

        return redirect()->route('chauffeurs.index')
            ->with('success', 'Chauffeur deleted successfully.');
    }


    public function indexs(Request $request)
    {
        $searchTerm = $request->input('search');

        $chauffeurs = Chauffeur::where('nom', 'LIKE', "%$searchTerm%")
                                 ->orWhere('prenom', 'LIKE', "%$searchTerm%")
                                 ->orWhere('email', 'LIKE', "%$searchTerm%")
                                 ->orWhere('tel', 'LIKE', "%$searchTerm%")
                                 ->orWhere('condition', 'LIKE', "%$searchTerm%")
                                 ->get();

        return view('chauffeurs.index', compact('chauffeurs', 'searchTerm'));
    }
    public function showCamion($chauffeur)
    {


        $camion = CamionRemourquage::findOrFail($chauffeur);
        return view('chauffeurs.showCamion', compact('camion'));
    }
    public function showCamionapi($chauffeur)
    {
        $camion = CamionRemourquage::findOrFail($chauffeur);

        if (!$camion) {
            return response()->json(['error' => 'Camion not found for chauffeur'], 404);
        }

        return response()->json($camion, 200);
    }
    public function getChauffeurapi($id) {
        $chauffeur = Chauffeur::find($id);

        if (!$chauffeur) {
            return response()->json(['error' => 'Chauffeur not found'], 404);
        }

        return response()->json($chauffeur, 200);
    }
    public function indexWithCondition($id)
    {

        $chauffeurs = Chauffeur::where('condition', 'non occupé')->get();
        $camions_remorquages = CamionRemourquage::whereNotIn('id', function($query) {
            $query->select('camion_remourquage_id')
                  ->from('chauffeurs');
        })->whereIn('etat', ['disponible'])->get();

        return view('demandes.condition', compact('chauffeurs', 'camions_remorquages'));
    }
    public function updateChauffeurDeviceToken($chauffeurId, $deviceToken)
    {
        $chauffeur = Chauffeur::find($chauffeurId);
        $chauffeur->device_token = $deviceToken;
        $chauffeur->save();
        return $chauffeur;
    }
public function auth(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');
    $device_token = $request->input('device_token');
    $chauffeur = Chauffeur::where('email', $email)->first();

    if ($chauffeur && Hash::check($password, $chauffeur->password)) {
        $token = $chauffeur->createToken('access_token')->accessToken;
        $updatedChauffeur = $this->updateChauffeurDeviceToken($chauffeur->id, $device_token);

        return response()->json([
            'message' => 'Authentication successful',
            'chauffeur' => $updatedChauffeur,
            'access_token' => $token
        ], 200);
    } else {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }
}



    public function authAdmin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $administrateur = Administrateur::where('email', $email)->first();

        if ($administrateur && $password === $administrateur->password) {
            // Authentication successful
            // Perform actions here for authenticated Administrateur
            return redirect()->route('dash'); // Example: Redirect to dashboard
        } else {
            // Invalid credentials
            // Perform actions here for failed authentication
            return redirect()->back()->withErrors(['error' => 'Invalid credentials']); // Example: Redirect back with error message
        }
    }
    public function updateCondition(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'condition' => 'required|string' // Add any validation rules as needed
        ]);

        // Find the chauffeur by ID
        $chauffeur = Chauffeur::find($id);

        if (!$chauffeur) {
            return response()->json(['error' => 'Chauffeur not found'], 404);
        }

        // Update the chauffeur's condition
        $chauffeur->condition = $request->input('condition');
        $chauffeur->save();

        return response()->json(['message' => 'Chauffeur condition updated successfully']);
    }


}








