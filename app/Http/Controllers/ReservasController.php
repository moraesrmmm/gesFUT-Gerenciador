<?php

namespace App\Http\Controllers;

use App\Models\Quadra;
use App\Models\Reserva;
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
        $quadras = Quadra::where('qrd_status', 'ATIVO')->get(); 
    
        return view('nova_reserva', ['quadras' => $quadras]);
    }
    
    public function getHorariosQuadra(Request $request) {
        $quadraId = $request->input('quadra_id');
        $data = $request->input('data'); // Recebe a data da requisição
    
        $quadra = Quadra::find($quadraId);
    
        if ($quadra) {
            $horaAbertura   = $quadra->qrd_hora_abertura; 
            $horaFechamento = $quadra->qrd_hora_fechamento;
    
            // Gere todos os intervalos de horas
            $intervalosDeHoras = $this->gerarIntervalosDeHoras($horaAbertura, $horaFechamento);
    
            // Busque as reservas existentes para a quadra e a data especificada
            $reservas = Reserva::where('quadra_id', $quadraId)
                ->whereDate('data_reserva', $data) // Filtra pelas reservas no dia
                ->pluck('hora_reserva') // Obtém as horas já reservadas
                ->toArray();
    
            // Filtra os horários disponíveis, removendo os horários reservados
            $horariosDisponiveis = array_diff($intervalosDeHoras, $reservas);
    
            return response()->json($horariosDisponiveis);
        }
    
        return response()->json([], 404); 
    }

}
