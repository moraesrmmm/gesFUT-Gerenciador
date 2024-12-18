<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'rsv_user_id',
        'rsv_quadra_id',
        'rsv_valor_total',
        'rsv_data',
        'rsv_data_cancelamento',
        'rsv_data_edicao',
        'rsv_horarios',
        'rsv_status',
    ];

    public function quadra()
    {
        return $this->belongsTo(Quadra::class, 'rsv_quadra_id');
    }

}
