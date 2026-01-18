@extends('adminlte::page')

@section('title', 'Lista de Detentos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('detentos.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Cadastrar
        </a>
    </div>
@stop

@section('content')
    {{-- Exibe mensagem de sucesso se houver --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-secondary card-outline">
        <div class="card-header">
            <h3 class="card-title">Detentos Cadastrados</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Matrícula</th>
                        <th>Data Inclusão</th>
                        <th>Tipo Inclusão</th>
                        <th>Guia Solicitada?</th>
                        <th>Status Guia</th>
                        <th>Nº Guia</th>
                        <th>Unidade Destino</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detentos as $detento)
                        <tr>
                            <td>{{ $detento->nome }}</td>
                            <td>{{ number_format($detento->matricula, 0, ',', '.') }}</td>

                            {{-- Formatação de data brasileira --}}
                            <td>{{ $detento->data_inclusao ? $detento->data_inclusao->format('d/m/Y') : '-' }}</td>

                            <td>{{ $detento->tipoInclusao->descricao ?? '-' }}</td>

                            {{-- Data da solicitação --}}
                            <td>{{ $detento->data_solicitacao ? $detento->data_solicitacao->format('d/m/Y') : '-' }}</td>

                            {{-- Lógica visual para o Status --}}
                            <td>
                                @if ($detento->saiu_guia)
                                    <span class="badge badge-success">Emitida</span>
                                @else
                                    <span class="badge badge-secondary">Aguardando</span>
                                @endif
                            </td>
                            <td>{{ $detento->numero_guia ?? '-' }}</td>
                            <td>{{ $detento->unidade_destino ?? '-' }}</td>
                            <td>
                                {{-- Botão Editar --}}
                                <a href="{{ route('detentos.edit', $detento->id) }}" class="btn btn-sm btn-info"
                                    title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Botão Excluir (Formulário é obrigatório para segurança) --}}
                                <form action="{{ route('detentos.destroy', $detento->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este detento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Nenhum registro encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $detentos->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@stop
