<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CarController;
use App\Models\Car;
use App\Models\CamionRemourquage;
use App\Models\CamionRemourquageCar;



class TruckController extends Controller
{
    public function index(Car $car)
    {
        $trucks = $car->camionRemourquage()->get();
        return view('trucks.index', [
            'car' => $car,
            'trucks' => $trucks
        ]);
    }
    public function show(CamionRemourquage $truck)
{
    return view('trucks.show', [
        'truck' => $truck
    ]);
}
public function edit(CamionRemourquage $truck)
{
    return view('trucks.edit', compact('truck'));
}
public function update(Request $request, CamionRemourquage $truck)
{
    $validatedData = $request->validate([
        'matricule' => 'required',
        'model' => 'required',
        'etat' => 'required',
    ]);

    $truck->matricule = $validatedData['matricule'];
    $truck->model = $validatedData['model'];
    $truck->etat = $validatedData['etat'];
    $truck->save();


    return redirect()->back()->with('message', 'successfully updated')->with('duration', '10000');

}
public function destroy(CamionRemourquage $truck)
{
    $truck->delete();

    return redirect()->back()->with('message', 'Truck deleted successfully!');
}
public function view()
{
    $trucks = CamionRemourquage::all();

    return view('trucks.view', compact('trucks'));
}
public function create()
{
    return view('trucks.create');
}


public function store(Request $request)
{
    $request->validate([
        'matricule' => 'required|unique:camion_remourquage',
        'model' => 'required',
        'etat' => 'required',
    ]);

    $truck = new CamionRemourquage;
    $truck->matricule = $request->matricule;
    $truck->model = $request->model;
    $truck->etat = $request->etat;
    $truck->save();

    return redirect()->route('trucks.view')->with('success', 'Truck created successfully!');
}

public function showCars($id)
{
    $truck = CamionRemourquage::findOrFail($id);
    $cars = CamionRemourquageCar::getCarsByTruckId($id);

    return view('trucks.cars', compact('cars', 'truck'));
}
public function search(Request $request)
{
    $search = $request->input('search');

    $trucks = CamionRemourquage::where('matricule', 'like', "%$search%")
                    ->orWhere('model', 'like', "%$search%")
                    ->orWhere('etat', 'like', "%$search%")
                    ->get();

    return view('trucks.view', ['trucks' => $trucks, 'search' => $search]);
}


}
