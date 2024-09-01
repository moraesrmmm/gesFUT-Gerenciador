<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reservas', [ReservasController::class, 'index'])->name('reservas.index');

Route::get('/reservas/nova', function () {
    return view('nova_reserva');
});

Route::get('/quadras', function () {
    return view('quadras');
});


