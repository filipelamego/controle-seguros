<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInclusao extends Model
{
    protected $table = 'tipo_inclusao';

    protected $fillable = [
        'descricao'
    ];

    public function solicitacoes()
    {
        return $this->hasMany(Detento::class, 'tipo_inclusao_id');
    }
}

