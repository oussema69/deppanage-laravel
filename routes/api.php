<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::post('clients/store', [ClientController::class, 'storeapi']);
Route::put('/clients/update/{id}', [ClientController::class, 'updateapi']);
Route::get('/clients/{id}', [ClientController::class, 'showApi']);
Route::get('clients/car/{id}',[ClientController::class, 'showCarsapi']);
Route::put('/chauffeur/update/{id}', [ChauffeurController::class, 'updateapi']);
Route::post('chauffeur/store', [ChauffeurController::class, 'storeapi']);
Route::get('camions-without-chauffeur',[ChauffeurController::class, 'camionapi']);
Route::get('chauffeur/camion/{chauffeur}',[ChauffeurController::class, 'showCamionapi']);
Route::get('chauffeur/get/{id}',[ChauffeurController::class, 'getChauffeurapi']);
Route::post('demande/create', [DemandeController::class, 'apiCreate']);
Route::patch('/demandes/{demande}/chauffeur/{chauffeur}', [DemandeController::class, 'assignChauffeur']);
Route::post('clients/auth', [ClientController::class, 'auth']);
Route::post('chauffeur/auth', [ChauffeurController::class, 'auth']);
Route::put('/chauffeurs/{id}/condition', [ChauffeurController::class, 'updateCondition']);
Route::put('/demandes/{id}/updateIsValid', [DemandeController::class, 'apiUpdateIsValid']);
///////////
Route::post('/register', [AuthController::class, 'register']);
Route::post('/chauffeur/login', [AuthController::class, 'login']);
Route::get('demandes/role/{id}/{type}',[DemandeController::class, 'getDemandesByRole'] );

