<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuadrasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasController;
require __DIR__.'/auth.php';

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
    return view('welcome');
})->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/reservas', [ReservasController::class, 'index'])->name('reservas.index');
    
    Route::get('/reservas/nova', [ReservasController::class, 'buscaQuadras'])->name('reservas.create');

    Route::post('/reservas/nova', [ReservasController::class, 'store'])->name('reservas.store');

    Route::get('//denuncia/nova', function () {
        return view('nova_denuncia');
    });

    Route::get('/get-horarios-quadra', [ReservasController::class, 'getHorariosQuadra']);

    Route::get('/quadras/nova', function () {
        return view('nova_quadra');
    });

    Route::get('/quadras', [QuadrasController::class, 'buscaAll'])->name('quadras.index');

    Route::post('/quadras/nova', [QuadrasController::class, 'cadastrarQuadra'])->name('quadras.store');

    Route::get('/buscar-cpf/{cpf}', [QuadrasController::class, 'buscarPorCpf']);
});


Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
   
    
});



require __DIR__.'/auth.php';
