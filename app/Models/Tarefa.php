<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'prioridade', 'status', 'user_id', 'vencimento'
    ];

    //Adicionando os enums
    public const PRIORIDADE_ALTA = 'Alta';
    public const PRIORIDADE_MEDIA = 'Média';
    public const PRIORIDADE_BAIXA = 'Baixa';

    public const PRIORIDADES = [
        self::PRIORIDADE_ALTA,
        self::PRIORIDADE_MEDIA,
        self::PRIORIDADE_BAIXA,
    ];

    public const STATUS_NAO_INICIADO = 'Não iniciado';
    public const STATUS_EM_PROGRESSO = 'Em progresso';
    public const STATUS_CONCLUIDO = 'Concluído';

    public const STATUSES = [
        self::STATUS_NAO_INICIADO,
        self::STATUS_EM_PROGRESSO,
        self::STATUS_CONCLUIDO,
    ];
}
