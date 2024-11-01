<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DenunciasController extends Controller
{
    public function buscaAllReservas()
    {
        // Carrega as reservas do usuário junto com as informações da quadra associada
        $reservas = Reserva::where('rsv_status', '!=', 'CANCELADA')->get(); 

        foreach ($reservas as $reserva) {
            $reserva->formatted_data = Carbon::parse($reserva->rsv_data)->format('d/m/Y');
        }
    
        return view('nova_denuncia', compact('reservas'));
    }

    public function buscaAllDenuncias()
    {
        if (Auth::user()->user_nivel != 99 && Auth::user()->user_nivel != 1) {
            return redirect()->route('reservas.index');
        }
    
        // Obtém o ID do usuário autenticado
        $userId = Auth::id();
    
        // Busca todas as denúncias com os dados da reserva onde o usuário tem acesso
        $denuncias = Denuncia::with('reserva')
            ->whereHas('reserva.quadra', function ($query) use ($userId) {
                $query->where('qrd_user_id', $userId)
                      ->orWhereRaw("FIND_IN_SET(?, qrd_users_edicao)", [$userId]);
            })
            ->get();
    
        return view('denuncias', compact('denuncias'));
    }
    

    public function cadastrarDenuncia(Request $request){

            Denuncia::create([
                'dnc_user_id' => auth()->user()->id,
                'dnc_rsv_id' => $request->dnc_rsv_id,
                'dnc_descricao' => $request->dnc_descricao,
                'dnc_data' => now(),
                'dnc_status' => 'PENDENTE'
            ]);

            return redirect()->route('denuncias.index')->with('success', 'Denuncia cadastrada com sucesso!');

        }
}
