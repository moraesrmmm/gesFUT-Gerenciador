<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $fillable = [
        'dnc_user_id',
        'dnc_rsv_id',
        'dnc_descricao',
        'dnc_data',
        'dnc_status',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'dnc_rsv_id'); // dnv_rsv_id é a chave estrangeira
    }
}
