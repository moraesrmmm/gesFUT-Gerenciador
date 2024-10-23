<?php

namespace App\Http\Controllers;

use App\Models\Quadra;
use Illuminate\Http\Request;

class ReservasController extends Controller
{

    public function index()
    {
        $reservas = ''; // Ou outra lógica para pegar as reservas
        return view('reservas', compact('reservas')); // A view que você deseja para listar as reservas
    }
    
    public function buscaQuadras()
    {
        $quadras = Quadra::all(); 
    
        return view('nova_reserva', ['quadras' => $quadras]);
    }
    
    public function gerarHoras($abertura, $fechamento)
    {
        $horas = [];
    
        // Converter as horas para objetos DateTime
        $horaAbertura = \DateTime::createFromFormat('H:i', $abertura);
        $horaFechamento = \DateTime::createFromFormat('H:i', $fechamento);
    
        // Adicionar as horas ao array
        while ($horaAbertura <= $horaFechamento) {
            $horas[] = $horaAbertura->format('H:i');
            $horaAbertura->modify('+1 hour'); // Incrementa 1 hora
        }

        return $horas;
    }
}
