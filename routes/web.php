<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DenunciasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuadrasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PremiumController;

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
    return redirect()->route('welcome');
})->middleware('guest');

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

Route::middleware('auth')->group(function () {
    
    Route::get('/pagamento/retorno', [ReservasController::class, 'pagamentoRetorno'])->name('pagamento.retorno');
    Route::get('/premium/retorno', [PremiumController::class, 'pagamentoRetorno'])->name('premium.retorno');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/reservas', [ReservasController::class, 'buscaAll'])->name('reservas.index');
    
    Route::get('/reservas/nova', [ReservasController::class, 'buscaQuadras'])->name('reservas.create');

    Route::post('/reservas/nova', [ReservasController::class, 'store'])->name('reservas.store');

    Route::post('/reservas', [PremiumController::class, 'store'])->name('premium.store');

    Route::post('/denuncia/nova', [DenunciasController::class, 'cadastrarDenuncia'])->name('denuncias.store');

    Route::get('/denuncia/nova', [DenunciasController::class, 'buscaAllReservas'])->name('denuncias.create');

    Route::get('/denuncias', [DenunciasController::class, 'buscaAllDenuncias'])->name('denuncias.index');

    Route::get('/get-horarios-quadra', [ReservasController::class, 'getHorariosQuadra']);

    Route::get('/quadras/nova', function () { return view('nova_quadra'); });

    Route::get('/quadras/nova', [QuadrasController::class, 'buscaAllUsuariosAtivos'])->name('quadras.busca.usuarios');

    Route::get('/quadras', [QuadrasController::class, 'buscaAll'])->name('quadras.index');

    Route::post('/quadras/nova', [QuadrasController::class, 'cadastrarQuadra'])->name('quadras.store');

    Route::get('/buscar-cpf/{cpf}', [QuadrasController::class, 'buscarPorCpf']);

    Route::patch('/reservas/{id}/excluir', [ReservasController::class, 'excluirReserva'])->name('reservas.destroy');

    Route::patch('/quadras/{id}/excluir', [QuadrasController::class, 'excluirQuadra'])->name('quadras.destroy');

    Route::get('/quadras/{id}/edit', [QuadrasController::class, 'edit'])->name('quadras.edit');
    
    Route::patch('/quadras/{id}', [QuadrasController::class, 'update'])->name('quadras.update');
    
});

