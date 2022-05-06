<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\IncidenciaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
//Devuelve vista de crear Registros
Route::get("/crear",[Controller::class,"create"])->name("controller.create");

//crea un registro
Route::post("/tecnicos",[TecnicoController::class, "store"])->name("tecnico.store");
Route::post("/incidencias",[IncidenciaController::class, "store"]) ->name("incidencia.store");
Route::post("/empresas",[EmpresaController::class, "store"]) ->name("empresa.store");


Route::get("/empresas",[EmpresaController::class,"index"])->name("empresa.index");
Route::delete("/empresas/{id}",[EmpresaController::class,"destroy"])->name("empresa.delete");
Route::put("/empresas/{id}",[EmpresaController::class,"update"])->name("empresa.update");

Route::get("/tecnicos",[TecnicoController::class,"index"])->name("tecnico.index");
Route::delete("/tecnicos/{id}",[TecnicoController::class,"destroy"])->name("tecnico.delete");
Route::put("/tecnicos",[TecnicoController::class,"update"])->name("tecnico.update");

Route::get("/incidencias",[IncidenciaController::class,"index"])->name("incidencia.index");