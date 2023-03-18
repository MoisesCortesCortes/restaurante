<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CamareroController;
use App\Http\Controllers\CocinaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/







//Rutas del apartado Cocina
Route::get('/cocina', CocinaController::class.'@index')->name('cocina');
Route::post('/cocina/{id}', CocinaController::class.'@listo')->name('cocina-listo');

//Rutas del apartado camarero para crear comanda, servirlas y marcar pedidos como pagado.
Route::get('/camarero', CamareroController::class.'@index')->name('camarero');
Route::post('/camarero', CamareroController::class.'@newComanda')->name('camarero');
Route::post('/camarero/{id}', CamareroController::class.'@servido')->name('camarero-servido');
Route::post('/pagado/{id}', CamareroController::class.'@pagado')->name('camarero-pagado');


//Rutas del apartado administracion para poder crear, editar, y eliminar platos.
Route::get('/',AdminController::class.'@index');
Route::get('/admin', AdminController::class.'@index')->name('admin');
Route::post('/admin', AdminController::class.'@addPlato');
Route::get('/plato/{id}',AdminController::class.'@showPlato')->name('plato-edit');
Route::patch('/plato/{id}',AdminController::class.'@updatePlato')->name('plato-update');
Route::delete('/plato/{id}',AdminController::class.'@borrarPlato')->name('plato-destroy');

