<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function index()
    {
        $mensagem = 'Olá, mundo!';
        return view('reservas', compact('mensagem'));
    }
}
