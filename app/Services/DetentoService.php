<?php

namespace App\Services;

use App\Models\Detento;
use App\Models\TipoInclusao;

class DetentoService
{

    public function getListagemPaginada(array $filters = [], $perPage = 10)
    {
        return Detento::with('tipoInclusao')
            ->where('ativo', 1)
            // Filtro por Nome
            ->when(isset($filters['nome']), function ($query) use ($filters) {
                $query->where('nome', 'like', '%' . $filters['nome'] . '%');
            })
            // Filtro por Matrícula
            ->when(isset($filters['matricula']), function ($query) use ($filters) {
                $query->where('matricula', $filters['matricula']);
            })
            // Filtro por Guia (Assumindo que seja o ID do tipo_inclusao)
            ->when(isset($filters['tipo_inclusao_id']), function ($query) use ($filters) {
                $query->where('tipo_inclusao_id', $filters['tipo_inclusao_id']);
            })
            // Lógica para Data de Inclusão (Início)
            // Se preencher só o início, traz tudo dessa data em diante
            ->when(!empty($filters['data_inclusao_inicio']), function ($query) use ($filters) {
                $query->whereDate('data_inclusao', '>=', $filters['data_inclusao_inicio']);
            })

            // Lógica para Data de Inclusão (Fim)
            // Se preencher só o fim, traz tudo do início dos tempos até essa data
            ->when(!empty($filters['data_inclusao_fim']), function ($query) use ($filters) {
                $query->whereDate('data_inclusao', '<=', $filters['data_inclusao_fim']);
            })
            ->orderBy('data_solicitacao', 'asc')
            ->paginate($perPage);
    }

    public function getTiposInclusao()
    {
        return TipoInclusao::orderBy('descricao')->get();
    }

    public function store(array $data)
    {
        return Detento::create($data);
    }

    public function update($id, array $data)
    {
        $detento = Detento::findOrFail($id);
        $detento->update($data);
        return $detento;
    }

    public function inativar($id)
    {
        $detento = Detento::findOrFail($id);
        $detento->ativo = false;
        return $detento->save();
    }

    public function buscarPorMatricula($matricula)
    {
        return Detento::where('matricula', $matricula)->first();
    }
}
