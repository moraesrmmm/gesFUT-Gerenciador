<?php

namespace App\Http\Controllers;

use App\Models\CadastroUsuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CadastroController extends Controller
{

    public function create()
    {
        return view('cadastro'); // Nome da view onde o formulário está localizado
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Criação do usuário
        CadastroUsuarios::create([
            'user_nome' => $request->name,
            'user_email' => $request->email,
            'user_senha' => Hash::make($request->senha),
            'user_cpf' => $request->cpf,
            'user_senha' => $request->password,
            'user_telefone' => $request->telefone,
            'user_status' => 'ativo',
            'user_nivel' => 0
        ]);

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('register')->with('success', 'Usuário registrado com sucesso!');
    }
    //
}
