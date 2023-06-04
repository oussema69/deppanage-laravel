<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index(Request $request)
{
    $searchTerm = $request->input('search');
    if ($searchTerm) {
        $clients = Client::where('nom', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('prenom', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('matricule', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('num_assurance', 'LIKE', '%' . $searchTerm . '%')
                          ->orWhere('tel', 'LIKE', '%' . $searchTerm . '%')
                          ->get();
        return view('clients.index', compact('clients', 'searchTerm'));
    } else {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }
}



public function showCars($id)
{
    $client = Client::with('cars:id,marque,modele,matricule,num_assurance,date_payment_assurance,date_fin,client_id')->findOrFail($id);
    $cars = $client->cars;
    return view('clients.cars', compact('client', 'cars'));
}
public function showCarsapi($id)
{
    $client = Client::with('cars:id,marque,modele,matricule,num_assurance,date_payment_assurance,date_fin,client_id')->findOrFail($id);
    $cars = $client->cars;

    return response()->json($cars, 200);
}


    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'email' => 'required|email|unique:clients',
                'password' => 'required|min:8',
                'matricule' => 'required|unique:clients',
                'tel' => 'required|digits:8',
                'num_assurance' => 'required'
            ]);
        } catch (ValidationException $exception) {
            return redirect()->back()->withErrors($exception->validator->getMessageBag());
        }

        $client = new Client([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'matricule' => $request->get('matricule'),
            'tel' => $request->get('tel'),
            'num_assurance' => $request->get('num_assurance')
        ]);

        $client->save();
        return redirect('/clients')->with('success', 'Client has been added');
    }
    public function storeapi(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'email' => 'required|email|unique:clients',
                'password' => 'required|min:8',
                'matricule' => 'required|unique:clients',
                'tel' => 'required|digits:8',
                'num_assurance' => 'required'
            ]);
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'errors' => $exception->validator->getMessageBag()
            ], 422);
        }

        $client = new Client([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'matricule' => $request->get('matricule'),
            'tel' => $request->get('tel'),
            'num_assurance' => $request->get('num_assurance')
        ]);

        $client->save();
        return response()->json([
            'message' => 'Client has been added',
            'client' => $client
        ], 201);
    }


    public function show($id)
    {
        $client = Client::find($id);
        return view('clients.show', compact('client'));
    }
    public function showApi($id)
    {
        $client = Client::find($id);

        if ($client) {
            return response()->json([
                'message' => 'Client found',
                'client' => $client
            ], 200);
        } else {
            return response()->json([
                'message' => 'Client not found'
            ], 404);
        }
    }
    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:clients,email,'.$id,
            'matricule' => 'required',
            'tel' => 'required|digits:8',
            'num_assurance' => 'required'
        ]);

        $client = Client::find($id);
        $client->nom = $request->get('nom');
        $client->prenom = $request->get('prenom');
        $client->email = $request->get('email');
        if (!empty($request->get('password'))) {
            $client->password = Hash::make($request->get('password'));
        }
        $client->matricule = $request->get('matricule');
        $client->tel = $request->get('tel');
        $client->num_assurance = $request->get('num_assurance');

        $client->save();
        return redirect('/clients')->with('success', 'Client has been updated');
    }
    public function updateapi(Request $request, $id)
{
    try {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:clients,email,'.$id,
            'matricule' => 'required',
            'tel' => 'required|digits:8',
            'num_assurance' => 'required'
        ]);
    } catch (ValidationException $exception) {
        return response()->json([
            'message' => $exception->getMessage(),
            'errors' => $exception->validator->getMessageBag()
        ], 422);
    }

    $client = Client::find($id);
    $client->nom = $request->get('nom');
    $client->prenom = $request->get('prenom');
    $client->email = $request->get('email');
    if (!empty($request->get('password'))) {
        $client->password = Hash::make($request->get('password'));
    }
    $client->matricule = $request->get('matricule');
    $client->tel = $request->get('tel');
    $client->num_assurance = $request->get('num_assurance');

    $client->save();
    return response()->json([
        'message' => 'Client has been updated',
        'client' => $client
    ], 200);
}


    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return redirect('/clients')->with('success', 'Client has been deleted Successfully');
    }

    public function auth(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $client = Client::where('email', $email)->first();

        if ($client && Hash::check($password, $client->password)) {
            if (!$client->isValid) {
                return response()->json([
                    'message' => 'Account not activated. Please activate your account.',
                ], 401);
            }

            return response()->json([
                'message' => 'Authentication successful',
                'client' => $client
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    }


    public function updateValidity($id)
    {
        $client = Client::findOrFail($id);
        $client->isValid = true;
        $client->save();

        // Optionally, you can return a response or redirect to another page
        return redirect()->back()->with('success', 'Client validity updated successfully.');
    }

}

