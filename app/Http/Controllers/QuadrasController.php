<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quadra;
use Illuminate\Http\Request;

class QuadrasController extends Controller
{
    
    public function buscarPorCpf($cpf){
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

    public function buscaAll()
    {
        $quadras = Quadra::all(); 
        return view('quadras', compact('quadras'));
    }

    public function cadastrarQuadra(Request $request){
        // dd($request->all());

        try{
            $request->validate([
                'qrd_nome' => ['required', 'string', 'max:255'],
                'qrd_endereco' => ['required', 'string','max:100'],
                'qrd_bairro' => ['required', 'string', 'max:100'],
                'qrd_cidade' => ['required', 'string','max:100'],
                'qrd_uf' => ['required', 'string', 'max:2'],
                'qrd_tamanho' => ['required', 'string','max:10'],
                'qrd_hora_abertura' => ['required', 'string'],
                'qrd_hora_fechamento' => ['required', 'string'],
                'qrd_hora_valor' => ['required', 'string'],
                'qrd_final_semana' => ['required', 'string'],
                'qrd_users_edicao' => ['string'],
                'qrd_imagem' => ['required'],
            ]);

            $imagePath = '';
            if ($request->hasFile('qrd_imagem')) { // Corrigido o nome para o correto
                $imagePath = $request->file('qrd_imagem')->store('imagens_quadras', 'public'); // Salva a imagem na pasta public/images
            }
    
            Quadra::create([
                'qrd_user_id' => auth()->user()->id,
                'qrd_nome' => $request->qrd_nome,
                'qrd_endereco' => $request->qrd_endereco,
                'qrd_bairro' => $request->qrd_bairro,
                'qrd_cidade' => $request->qrd_cidade,
                'qrd_uf' => $request->qrd_uf,
                'qrd_tamanho' => $request->qrd_tamanho,
                'qrd_hora_abertura' => $request->qrd_hora_abertura,
                'qrd_hora_fechamento' => $request->qrd_hora_fechamento,
                'qrd_hora_valor' => $request->qrd_hora_valor,
                'qrd_final_semana' => $request->qrd_final_semana,
                'qrd_users_edicao' => $request->qrd_users_edicao,
                'qrd_imagem' => $imagePath,
                'qrd_dt_criacao' => now(),
                'qrd_dt_atualizacao' => now(),
                'qrd_status' => 'ATIVO'
            ]);

            return redirect()->route('quadras.index')->with('success', 'Quadra cadastrada com sucesso!');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar quadra: ' . $e->getMessage(),
            ], 500);
        }
        

    }

}
