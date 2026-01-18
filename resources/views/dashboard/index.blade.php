@extends('adminlte::page')

@section('content')
    <div class="row mt-3">

        {{-- BOX 1: Total de Detentos --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalDetentos }}</h3>
                    <p>Total de Detentos Cadastrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('detentos.index') }}" class="small-box-footer">
                    Ver Detalhes <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- BOX 2: Guias Emitidas --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $guiasEmitidas ?? 'Nenhuma guia' }}</h3>
                    <p>Guias Emitidas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                {{-- Botão que abre o accordion --}}
                <a data-toggle="collapse" href="#detentosGuiasEmitidas" role="button" aria-expanded="false"
                   aria-controls="detentosGuiasEmitidas" class="small-box-footer">
                    Ver Detalhes <i class="fas fa-arrow-circle-down"></i>
                </a>
            </div>
        </div>

        {{-- BOX 3: Guias Aguardando --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $guiasAguardando ?? 'Nenhuma guia' }}</h3>
                    <p>Guias Aguardando Emissão</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                {{-- Botão que abre o accordion --}}
                <a data-toggle="collapse" href="#detentosAguardandoGuia" role="button" aria-expanded="false"
                   aria-controls="detentosAguardandoGuia" class="small-box-footer">
                    Ver Detalhes <i class="fas fa-arrow-circle-down"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- INÍCIO DO GRUPO ACCORDION --}}
    <div id="accordionGuias">
        {{-- SEÇÃO 1: Detentos com Guias Emitidas --}}
        <div class="collapse mt-3" id="detentosGuiasEmitidas" data-parent="#accordionGuias">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Detentos com Guias Emitidas</h3>
                </div>
                {{-- Removi o p-0 para dar espaço e evitar bugs visuais --}}
                <div class="card-body">
                    @if ($detentosGuiasEmitidas->isEmpty())
                        <p>Nenhum detento com guia emitida.</p>
                    @else
                        {{-- Adicionei table-bordered (linhas) e table-striped (zebrado) --}}
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Matrícula</th>
                                    <th>Nome</th>
                                    <th>Nº Guia</th>
                                    <th>Unidade Destino</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detentosGuiasEmitidas as $detento)
                                    <tr>
                                        <td>{{ number_format($detento->matricula, 0, ',', '.') }}</td>
                                        <td>{{ $detento->nome }}</td>
                                        <td>{{ $detento->numero_guia }}</td>
                                        <td>{{ $detento->unidade_destino }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        {{-- SEÇÃO 2: Detentos Aguardando Guias --}}
        <div class="collapse mt-3" id="detentosAguardandoGuia" data-parent="#accordionGuias">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Detentos Aguardando Guias</h3>
                </div>
                <div class="card-body">
                    @if ($detentosAguardandoGuia->isEmpty())
                        <p>Nenhum detento aguardando guia.</p>
                    @else
                        {{-- Adicionei table-bordered (linhas) e table-striped (zebrado) --}}
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Matrícula</th>
                                    <th>Nome</th>
                                    <th>Situação</th>
                                    <th>Data Inclusão</th>
                                    <th>Data Solicitação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detentosAguardandoGuia as $det)
                                    <tr>
                                        <td>{{ number_format($det->matricula, 0, ',', '.') }}</td>
                                        <td>{{ $det->nome }}</td>
                                        <td>{{ $det->tipoInclusao->descricao ?? 'N/A' }}</td>
                                        <td>
                                            {{ $det->data_inclusao ? \Carbon\Carbon::parse($det->data_inclusao)->format('d/m/Y') : '-' }}
                                        </td>
                                        <td>
                                            {{ $det->data_solicitacao ? \Carbon\Carbon::parse($det->data_solicitacao)->format('d/m/Y') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div> {{-- FIM DO GRUPO ACCORDION --}}
@stop
