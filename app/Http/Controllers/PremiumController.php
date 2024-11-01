<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercadoPago\SDK;

class PremiumController extends Controller
{
    public function store(Request $request)
    {
        SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        $preference = new \MercadoPago\Preference();
        
        $item = new \MercadoPago\Item();
        $item->title = 'Premium GesFut';
        $item->quantity = 1;
        $item->unit_price = floatval(str_replace(',', '.', 50));
        
        $preference->items = array($item);
        
        $payer = new \MercadoPago\Payer();
        $payer->email = "romulo_moraes2018@hotmail.com"; // Email de uma conta diferente
        
        $preference->payer = $payer;
        
        $preference->back_urls = [
            "success" => route('premium.retorno'),
            "failure" => route('premium.retorno'),
            "pending" => route('premium.retorno'),
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

            $userId = auth()->id();

            DB::table('usuarios')
            ->where('id', $userId) 
            ->update(['user_nivel' => 1]);

            return redirect()->route('reservas.index')->with('success', 'Premium concedido!');
        } else {
            return redirect()->route('reservas.index')->with('error', 'Pagamento não foi aprovado. Tente novamente.');
        }
    }
}
