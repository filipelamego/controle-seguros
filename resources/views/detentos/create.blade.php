@extends('adminlte::page')

@section('title', 'Cadastrar Seguro')

@section('content_header')
    <h3>Cadastrar Seguro</h3>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('detentos.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row col-12">
                    <div class="col-md-6 form-group">
                        <label>Matrícula</label>
                        <input type="text" name="matricula" class="form-control" required autofocus>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                </div>
                <div class="row col-12">
                    <div class="col-md-4 form-group">
                        <label>Data de Inclusão</label>
                        <input type="date" name="data_inclusao" class="form-control" required>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Situação</label>
                        <select name="tipo_inclusao_id" class="form-control" required>
                            <option value="">Selecione...</option>
                            @foreach ($tipoInclusao as $tipo)
                                <option value="{{ $tipo->id }}">
                                    {{ $tipo->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Data Solicitação Guia</label>
                        <input type="date" name="data_solicitacao" class="form-control">
                    </div>
                </div>

                <div class="row col-12">
                    <div class="col-md-4 form-group">
                        <label>Já saiu a guia?</label>
                        <select name="saiu_guia" class="form-control">
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Número da Guia</label>
                        <input type="text" name="numero_guia" class="form-control">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Unidade de Destino</label>
                        <input type="text" name="unidade_destino" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
@stop

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const matriculaInput = document.querySelector('input[name="matricula"]');
        const nomeInput = document.querySelector('input[name="nome"]');

        matriculaInput.addEventListener('blur', function() {
            const matricula = this.value.trim();
            if (!matricula) return;

            fetch(`/detentos/buscar?matricula=${matricula}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        nomeInput.value = data.nome || '';
                    } else {
                        nomeInput.value = '';
                    }
                })
                .catch(error => console.error(error));
        });
    });
</script>
