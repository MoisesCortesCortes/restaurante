<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CamareroController;
use App\Http\Controllers\CocinaController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rutas del apartado Cocina
    Route::get('/cocina', [CocinaController::class , 'index'])->name('cocina')->middleware('cocinero');
    Route::post('/cocina/{id}', [CocinaController::class , '@listo'])->name('cocina-listo')->middleware('cocinero');

    //Rutas del apartado camarero para crear comanda, servirlas y marcar pedidos como pagado.
    Route::get('/camarero', [CamareroController::class , 'index'])->name('camarero')->middleware('camarero');
    Route::post('/camarero', [CamareroController::class , 'newComanda'])->name('camarero')->middleware('camarero');
    Route::post('/camarero/{id}', [CamareroController::class , 'servido'])->name('camarero-servido')->middleware('camarero');
    Route::post('/pagado/{id}', [CamareroController::class , 'pagado'])->name('camarero-pagado')->middleware('camarero');


    //Rutas del apartado administracion para poder crear, editar, y eliminar platos.
    Route::get('/admin', [AdminController::class , 'index'])->name('admin')->middleware('admin');
    Route::post('/admin', [AdminController::class , 'addPlato'])->middleware('admin');
    Route::get('/plato/{id}', [AdminController::class , 'showPlato'])->name('plato-edit')->middleware('admin');
    Route::patch('/plato/{id}', [AdminController::class , 'updatePlato'])->name('plato-update')->middleware('admin');
    Route::delete('/plato/{id}', [AdminController::class , 'borrarPlato'])->name('plato-destroy')->middleware('admin');
});




require __DIR__ . '/auth.php';
