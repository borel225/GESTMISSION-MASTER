<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\CategorieAgentController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\LieuController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TypeMissionController;
use App\Http\Controllers\ParametrePerdiemController;
use App\Http\Controllers\OdreMissionController;







Route::get('/',[HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('fonctions', FonctionController::class);
Route::resource('services', ServiceController::class);
Route::resource('lieus',LieuController::class);
Route::resource('agents', AgentController::class);
Route::resource('missions', MissionController::class);
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('categorie_agent', CategorieAgentController::class);
Route::resource('type_missions', TypeMissionController::class);
Route::resource('parametre_perdiems',ParametrePerdiemController::class);


Auth::routes();




Route::get('/get-categories/{typeMissionId}', [HomeController::class, 'getCategories']);
Route::get('/get-montant/{typeMissionId}/{categorieAgentId}', [HomeController::class, 'getMontant']);
Route::get('/details', [HomeController::class, 'details'])->name('details');

Route::middleware(['auth'])->group(function () {
    Route::get('/ordre-missions', [OdreMissionController::class, 'listMissionAgent'])->name('ordre_missions.index');
    Route::get('/validation', [OdreMissionController::class, 'listMissionAvalider'])->name('ordre_missions.validations');
    Route::get('/demande/{id}', [OdreMissionController::class, 'showDemandeForm'])->name('demande');
    Route::post('/submit-demande/{id}', [OdreMissionController::class, 'submitDemande'])->name('submit_demande');

});

