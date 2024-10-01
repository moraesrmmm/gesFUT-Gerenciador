<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class QuadrasController extends Controller
{
    
    public function buscarPorCpf($cpf)
    {
        // Busca o usuário pelo CPF
        $usuario = User::where('user_cpf', $cpf)->first();

        if ($usuario) {
            return response()->json([
                'success' => true,
                'nome' => $usuario->user_nome, 
            ]);
        }

        return response()->json(['success' => false]);
    }

}
