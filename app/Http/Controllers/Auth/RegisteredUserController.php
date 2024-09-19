<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,user_email', // Verificando email único na tabela correta
            'password' => 'required|string|min:8|confirmed',
            'cpf' => 'required|string|max:14|unique:usuarios,user_cpf', // CPF deve ser único e validado
            'telefone' => 'required|string|max:15', // Validar telefone
        ]);

        $user = User::create([
            'user_nome' => $request->name,
            'user_email' => $request->email,
            'user_senha' => Hash::make($request->password), // Criptografando a senha
            'user_cpf' => $request->cpf,
            'user_telefone' => $request->telefone,
            'user_status' => 'ativo',
            'user_nivel' => 0,
            'user_dt_criacao' => now(), // Usando a função now() do Laravel
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
