<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detento extends Model
{
    use HasFactory;

    protected $table = 'detentos';

    protected $fillable = [
        'nome',
        'matricula',
        'data_inclusao',
        'tipo_inclusao_id',
        'data_solicitacao',
        'saiu_guia',
        'numero_guia',
        'unidade_destino',
        'ativo'
    ];

    protected $casts = [
        'saiu_guia' => 'boolean',
        'data_inclusao' => 'date',
        'data_solicitacao' => 'date',
    ];

    public function tipoInclusao()
    {
        return $this->belongsTo(TipoInclusao::class, 'tipo_inclusao_id');
    }
}
