<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemovalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnpj',
        'nome',
        'email',
        'vinculo',
        'motivo',
        'aceite_lgpd',
        'confirmacao_responsavel',
        'entende_prazo_buscas',
        'token',
        'ip',
        'user_agent',
    ];
}
