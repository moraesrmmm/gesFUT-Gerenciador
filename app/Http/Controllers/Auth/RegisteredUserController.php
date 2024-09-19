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
        // dd($request->all());
        $request->validate([
            'user_nome' => ['required', 'string', 'max:255'],
            'user_email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'user_cpf' => ['required', 'string', 'email', 'max:11', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'user_nome' => $request->user_nome,
            'user_cpf' => $request->user_cpf,
            'user_email' => $request->user_email,
            'user_senha' => Hash::make($request->password),
            'user_nivel' => '0',
            'user_dt_criacao' => now(),
            'user_status' => 'ATIVO',
            'user_telefone' => $request->user_telefone
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
