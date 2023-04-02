<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\ClientController;
use App\Models\Client;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        return redirect()->back()->with('success', 'Car deleted successfully!');
    }
    public function show(Car $car)
    {
        return view('cars.show', ['car' => $car]);
    }
    public function update(Request $request, Car $car)
    {
        try {
            $validatedData = $request->validate([
                'marque' => 'required|string|max:255',
                'modele' => 'required|string|max:255',
                'matricule' => 'required|string|max:255',
                'num_assurance' => 'required|string|max:255',
                'date_payment_assurance' => 'required|date',
                'date_fin' => 'required|date|after:date_payment_assurance',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }

        $car->update($validatedData);

        return redirect()->route('cars.show', ['car' => $car->id])->with('success', 'Car details have been updated successfully!');
    }

    public function create(Client $client)
    {
        return view('cars.create', compact('client'));
    }


    public function store(Request $request, $clientId)
    {
        try {
            $validatedData = $request->validate([
                'marque' => 'required|string|max:255',
                'modele' => 'required|string|max:255',
                'matricule' => 'required|string|unique:cars|max:255',
                'num_assurance' => 'required|string|max:255',
                'date_payment_assurance' => 'required|date',
                'date_fin' => 'required|date|after:date_payment_assurance',
            ]);

            $car = new Car($validatedData);
            $car->client_id = $clientId; // Set the client ID for the car

            $car->save();

            return redirect()->route('clients.cars', ['id' => $clientId])->with('success', 'Car has been added successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }
    }

    public function showClients(Car $car)
    {
        $client = $car->client;
        return view('cars.clients.show', compact('client', 'car'));
    }


}
