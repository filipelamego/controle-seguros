@extends('adminlte::page')

@section('title', 'Editar Detento')

@section('content_header')
    <h1>Editar Guia de Detento</h1>
@stop

@section('content')
    <div class="card card-warning">
        <form action="{{ route('detentos.update', $detento->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                {{-- Linha 1 --}}
                <div class="row col-12">
                    <div class="col-md-6 form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" value="{{ old('nome', $detento->nome) }}"
                            required autofocus>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Matrícula</label>
                        <input type="text" name="matricula" class="form-control"
                            value="{{ old('matricula', $detento->matricula) }}" required>
                    </div>
                </div>

                {{-- Linha 2 --}}
                <div class="row col-12">
                    <div class="col-md-4 form-group">
                        <label>Data de Inclusão</label>
                        <input type="date" name="data_inclusao" class="form-control"
                            value="{{ old('data_inclusao', optional($detento->data_inclusao)->format('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Tipo Inclusão</label>
                        <select name="tipo_inclusao_id" class="form-control" required>
                            <option value="">Selecione...</option>
                            @foreach ($tipoInclusao as $tipo)
                                <option value="{{ $tipo->id }}"
                                    {{ old('tipo_inclusao_id', $detento->tipo_inclusao_id) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Data Solicitação Guia</label>
                        <input type="date" name="data_solicitacao" class="form-control"
                            value="{{ old('data_solicitacao', optional($detento->data_solicitacao)->format('Y-m-d')) }}">
                    </div>
                </div>

                {{-- Linha 3 --}}
                <div class="row col-12">
                    <div class="col-md-4 form-group">
                        <label>Já saiu a guia?</label>
                        <select name="saiu_guia" class="form-control">
                            <option value="0" {{ old('saiu_guia', $detento->saiu_guia) == 0 ? 'selected' : '' }}>
                                Não
                            </option>
                            <option value="1" {{ old('saiu_guia', $detento->saiu_guia) == 1 ? 'selected' : '' }}>
                                Sim
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Número da Guia</label>
                        <input type="text" name="numero_guia" class="form-control"
                            value="{{ old('numero_guia', $detento->numero_guia) }}">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Unidade de Destino</label>
                        <input type="text" name="unidade_destino" class="form-control"
                            value="{{ old('unidade_destino', $detento->unidade_destino) }}">
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    Atualizar
                </button>

                <a href="{{ route('detentos.index') }}" class="btn btn-default">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@stop
