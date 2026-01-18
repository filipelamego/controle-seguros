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
                    <tr>
                        <th>Nome</th>
                        <th>Matrícula</th>
                        <th>Inclusão</th>
                        <th>Tipo</th>
                        <th>Guia Solicitada</th>
                        <th>Status</th>
                        <th>Nº Guia</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detentos as $detento)
                        <tr>
                            <td>{{ $detento->nome }}</td>
                            <td>{{ number_format($detento->matricula, 0, ',', '.') }}</td>
                            <td>{{ $detento->data_inclusao?->format('d/m/Y') ?? '-' }}</td>
                            <td>{{ $detento->tipoInclusao->descricao ?? '-' }}</td>
                            <td>{{ $detento->data_solicitacao?->format('d/m/Y') ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $detento->saiu_guia ? 'badge-success' : 'badge-secondary' }}">
                                    {{ $detento->saiu_guia ? 'Emitida' : 'Aguardando' }}
                                </span>
                            </td>
                            <td>{{ $detento->numero_guia ?? '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('detentos.edit', $detento->id) }}" class="btn btn-sm btn-info"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('detentos.destroy', $detento->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Inativar este cadastro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Inativar">
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
                <div class="float-right">
                    {{ $detentos->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </div>
@stop
