@extends('adminlte::page')

@section('title', 'Lista de Detentos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Gerenciamento de Detentos</h1>
        <a href="{{ route('detentos.create') }}" class="btn btn-success">
            <i class="fas fa-plus mr-1"></i> Cadastrar
        </a>
    </div>
@stop

@section('content')
    {{-- Renderiza o arquivo de pesquisa --}}
    @include('detentos.search')

    <div class="card card-secondary card-outline">
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr class="text-uppercase">
                        <th>Nome</th>
                        <th class="text-center">Matrícula</th>
                        <th class="text-center">Inclusão</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Guia Solicitada</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Nº Guia</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detentos as $detento)
                        <tr>
                            <td>{{ $detento->nome }}</td>
                            <td class="text-center">{{ number_format($detento->matricula, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $detento->data_inclusao?->format('d/m/Y') ?? '-' }}</td>
                            <td class="text-center">{{ $detento->tipoInclusao->descricao ?? '-' }}</td>
                            <td class="text-center">{{ $detento->data_solicitacao?->format('d/m/Y') ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge {{ $detento->saiu_guia ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $detento->saiu_guia ? 'Emitida' : 'Aguardando' }}
                                </span>
                            </td>
                            <td class="text-center">{{ $detento->numero_guia ?? '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('detentos.edit', $detento->id) }}" class="btn btn-sm btn-info mr-1"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('detentos.destroy', $detento->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Inativar este cadastro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">Nenhum registro encontrado para os filtros
                                aplicados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($detentos->hasPages())
            <div class="card-footer clearfix">
                {{ $detentos->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@stop
