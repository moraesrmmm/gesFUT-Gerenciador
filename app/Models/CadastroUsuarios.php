<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastroUsuarios extends Model
{
    use HasFactory;

    // Define a tabela associada ao modelo
    protected $table = 'usuarios';

    // Permite atribuição em massa para esses campos
    protected $fillable = [
        'user_nome',
        'user_email',
        'user_senha',
        'user_cpf',
        'user_telefone',
        'user_status',
        'user_nivel',
        'user_dt_criacao',
    ];
}
