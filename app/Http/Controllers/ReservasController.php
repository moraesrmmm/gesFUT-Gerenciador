<?php

namespace App\Http\Controllers;

use App\Models\Quadra;
use App\Models\Reserva;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use MercadoPago\SDK;

class ReservasController extends Controller
{

    public function buscaAll()
    {
        $userId = auth()->id();
        
        // Carrega as reservas do usuário junto com as informações da quadra associada
        $reservas = Reserva::where('rsv_user_id', $userId)
        ->where('rsv_status', '!=', 'EXCLUIDO') // Verifica se o status não é "EXCLUIDO"
        ->with('quadra') // Carrega o relacionamento com `Quadra`
        ->get();

        foreach ($reservas as $reserva) {
            $reserva->formatted_data = Carbon::parse($reserva->rsv_data)->format('d/m/Y');
        }
    
        return view('reservas', compact('reservas'));
    }

    public function store(Request $request)
    {
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        $preference = new \MercadoPago\Preference();
        
        $item = new \MercadoPago\Item();
        $item->title = 'Reserva de Quadra';
        $item->quantity = 1;
        $item->unit_price = floatval(str_replace(',', '.', $request->rsv_valor_total));
        
        $preference->items = array($item);
        
        $payer = new \MercadoPago\Payer();
        $payer->email = "romulo_moraes2018@hotmail.com"; // Email de uma conta diferente
        
        $preference->payer = $payer;
        
        $preference->back_urls = [
            "success" => route('pagamento.retorno', ['rsv_quadra_id' => $request->rsv_quadra_id, 'rsv_valor_total' => $request->rsv_valor_total, 'rsv_data' => $request->rsv_data, 'rsv_horarios' => $request->rsv_horarios]),
            "failure" => route('pagamento.retorno'),
            "pending" => route('pagamento.retorno'),
        ];
        $preference->auto_return = "approved"; // Retorno automático
        
        $preference->save();
        
        return redirect($preference->init_point);
    
    }

    public function pagamentoRetorno(Request $request)
    {

        \MercadoPago\SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
        $paymentId = $request->input('payment_id');
        $payment = \MercadoPago\Payment::find_by_id($paymentId);

        if ($payment->status == 'approved') {

            Reserva::create([
                'rsv_user_id' => auth()->id(), // ID do usuário autenticado
                'rsv_quadra_id' => $request->input('rsv_quadra_id'),
                'rsv_valor_total' => $request->input('rsv_valor_total'),
                'rsv_data' => $request->input('rsv_data'),
                'rsv_data_cancelamento' => null,
                'rsv_data_edicao' => null,
                'rsv_horarios' => $request->input('rsv_horarios'),
                'rsv_status' => 'CONFIRMADO', // Ou o status que você quiser
            ]);

            return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
        } else {
            return redirect()->route('reservas.index')->with('error', 'Pagamento não foi aprovado. Tente novamente.');
        }
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

    public function excluirReserva($id)
    {
        $reserva = Reserva::findOrFail($id);
    
        $reserva->update(['rsv_status' => 'EXCLUIDO']);
    
        return redirect()->route('reservas.index')->with('success', 'Reserva excluída com sucesso!');
    }

}
