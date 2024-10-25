<?php

namespace App\Http\Controllers;

use App\Models\Quadra;
use Illuminate\Http\Request;

class ReservasController extends Controller
{

    public function index()
    {
        $reservas = ''; 
        return view('reservas', compact('reservas'));
    }
    
    public function buscaQuadras()
    {
        $quadras = Quadra::all(); 
    
        return view('nova_reserva', ['quadras' => $quadras]);
    }
    
    public function getHorariosQuadra(Request $request) {
        $quadraId = $request->input('quadra_id');
    
        $quadra = Quadra::find($quadraId);
    
        if ($quadra) {
            $horaAbertura   = $quadra->qrd_hora_abertura; 
            $horaFechamento = $quadra->qrd_hora_fechamento;
            
            $intervalosDeHoras = $this->gerarIntervalosDeHoras($horaAbertura, $horaFechamento);
    
            return response()->json($intervalosDeHoras);
        }
    
        return response()->json([], 404); 
    }
    
    private function gerarIntervalosDeHoras($horaAbertura, $horaFechamento) {
        $intervalos = [];
        $horaAtual = strtotime($horaAbertura);
        $horaLimite = strtotime($horaFechamento);
    
        while ($horaAtual < $horaLimite) {
            $proximaHora = strtotime('+1 hour', $horaAtual);
            $intervalo = date('H:i', $horaAtual) . ' - ' . date('H:i', $proximaHora);
            $intervalos[] = $intervalo;
            $horaAtual = $proximaHora;
        }
    
        return $intervalos;
    }

}
