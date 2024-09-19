<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\CadastroUsuarioController;

require __DIR__.'/auth.php';

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/reservas', [ReservasController::class, 'index'])->name('reservas.index');
    
    Route::get('/reservas/nova', function () {
        return view('nova_reserva');
    });

    Route::get('/quadras', function () {
        return view('quadras');
    });

    Route::get('/quadras/nova', function () {
        return view('nova_quadra');
    });
    
});

Route::get('/register', function () {
    return redirect('/login'); // ou qualquer outra rota
});
