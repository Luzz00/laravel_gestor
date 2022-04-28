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
Route::post("/empresa",[EmpresaController::class, "store"]) ->name("empresa.store");
Route::post("/incidencia",[IncidenciaController::class, "store"]) ->name("incidencia.store");

Route::get("/empresas",[EmpresaController::class,"index"])->name("empresa.index");

Route::get("/incidencias",[IncidenciaController::class,"index"]);

Route::get("/incidenciasFiltro",[IncidenciaController::class,"indexFiltro"])->name("incidencias.indexFiltro");

Route::get("/datos2",[TecnicoController::class,"index"])->name("tecnico.index");