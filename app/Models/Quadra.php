<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quadra extends Model
{
    use HasFactory;

    protected $fillable = [
        'qrd_user_id',
        'qrd_nome',
        'qrd_endereco',
        'qrd_bairro',
        'qrd_cidade',
        'qrd_uf',
        'qrd_tamanho',
        'qrd_hora_abertura',
        'qrd_hora_fechamento',
        'qrd_hora_valor',
        'qrd_final_semana',
        'qrd_users_edicao',
        'qrd_imagem',
        'qrd_dt_criacao',
        'qrd_dt_atualizacao',
        'qrd_status',
    ];

}
