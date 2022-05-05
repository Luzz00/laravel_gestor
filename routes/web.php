<?php

use Illuminate\Support\Facades\Route;
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
Route::get("/tecnico",[TecnicoController::class,"create"])->name("tecnico.create");
Route::post("/tecnico",[TecnicoController::class, "store"])->name("tecnico.store");


Route::post("/incidencia",[IncidenciaController::class, "store"]) ->name("incidencia.store");

Route::get("/empresa",[EmpresaController::class,"index"])->name("empresa.index");
Route::post("/empresa",[EmpresaController::class, "store"]) ->name("empresa.store");
Route::delete("/empresa/{id}",[EmpresaController::class,"destroy"])->name("empresa.delete");
Route::put("/empresa/{id}",[EmpresaController::class,"update"])->name("empresa.update");


Route::get("/incidencias",[IncidenciaController::class,"index"]);

Route::get("/incidenciasFiltro",[IncidenciaController::class,"indexFiltro"])->name("incidencias.indexFiltro");

Route::get("/datos2",[TecnicoController::class,"index"])->name("tecnico.index");
//Route::get("/tecnico/{id}",[TecnicoController::class,"show"])->name("tecnico.show");
Route::delete("/datos2/{id}",[TecnicoController::class,"destroy"])->name("tecnico.delete");
