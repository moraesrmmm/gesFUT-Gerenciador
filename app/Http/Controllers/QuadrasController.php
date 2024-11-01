<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quadra;
use Illuminate\Http\Request;

class QuadrasController extends Controller
{

    public function buscaAll()
    {
        $userId = auth()->id();
        
        $quadras = Quadra::where(function($query) use ($userId) {
            // Condição para o usuário ser o proprietário ou estar na lista de editores
            $query->where('qrd_user_id', $userId)
                  ->orWhereRaw("FIND_IN_SET(?, qrd_users_edicao)", [$userId]);
        })
        ->where('qrd_status', '!=', 'EXCLUIDO') // Filtra o status fora do grupo
        ->get();
        
        return view('quadras', compact('quadras'));
    }
    

    public function buscaAllUsuariosAtivos()
    {
        $usuarios = User::where('user_status', 'ATIVO')->get(); 
        return view('nova_quadra', compact('usuarios'));
    }

    public function cadastrarQuadra(Request $request){

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
                'qrd_users_edicao' => ['array'],
                'qrd_imagem' => ['required'],
            ]);

            $usuariosEdicao = $request->input('qrd_users_edicao', []);
            $usuariosEdicaoString = implode(';', $usuariosEdicao);

            $imagePath = '';
            if ($request->hasFile('qrd_imagem')) { 
                $imagePath = $request->file('qrd_imagem')->store('imagens_quadras', 'public'); 
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
                'qrd_users_edicao' => $usuariosEdicaoString,
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

    public function excluirQuadra($id)
    {
        $quadra = Quadra::findOrFail($id);
    
        $quadra->update(['qrd_status' => 'EXCLUIDO']);
    
        return redirect()->route('quadras.index')->with('success', 'Quadra excluída com sucesso!');
    }


    public function edit($id)
    {
        // Busca a quadra pelo ID
        $quadra = Quadra::findOrFail($id);
        
        // Busca todos os usuários (ou aqueles relevantes)
        $usuarios = User::all(); // ou ajuste a consulta conforme necessário
    
        // Retorna a view com os dados da quadra e os usuários
        return view('editar_quadra', compact('quadra', 'usuarios'));
    }
    
    public function update(Request $request, $id)
    {
        try {
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
                'qrd_users_edicao' => ['array'],
                'qrd_imagem' => ['nullable'], // Imagem pode ser nula durante a edição
            ]);
    
            // Busca a quadra existente
            $quadra = Quadra::findOrFail($id);
    
            // Atualiza os dados da quadra
            $quadra->qrd_nome = $request->qrd_nome;
            $quadra->qrd_endereco = $request->qrd_endereco;
            $quadra->qrd_bairro = $request->qrd_bairro;
            $quadra->qrd_cidade = $request->qrd_cidade;
            $quadra->qrd_uf = $request->qrd_uf;
            $quadra->qrd_tamanho = $request->qrd_tamanho;
            $quadra->qrd_hora_abertura = $request->qrd_hora_abertura;
            $quadra->qrd_hora_fechamento = $request->qrd_hora_fechamento;
            $quadra->qrd_hora_valor = $request->qrd_hora_valor;
            $quadra->qrd_final_semana = $request->qrd_final_semana;
    
            // Processa os usuários que podem editar
            $usuariosEdicao = $request->input('qrd_users_edicao', []);
            $quadra->qrd_users_edicao = implode(';', $usuariosEdicao);
    
            // Se uma nova imagem for enviada, atualiza o caminho
            if ($request->hasFile('qrd_imagem')) {
                $quadra->qrd_imagem = $request->file('qrd_imagem')->store('imagens_quadras', 'public');
            }
    
            // Salva as alterações
            $quadra->qrd_dt_atualizacao = now();
            $quadra->save();
    
            return redirect()->route('quadras.index')->with('success', 'Quadra atualizada com sucesso!');
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar quadra: ' . $e->getMessage(),
            ], 500);
        }
    }
    



}
