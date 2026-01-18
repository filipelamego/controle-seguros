<div id="accordion">
    <div class="card card-secondary card-outline">
        <a class="d-block w-100" data-toggle="collapse" href="#collapseSearch">
            <div class="card-header">
                <h4 class="card-title w-100">
                    <i class="fas fa-search mr-2"></i> Pesquisar
                </h4>
            </div>
        </a>
        <div id="collapseSearch"
            class="collapse {{ request()->anyFilled(['nome', 'matricula', 'tipo_inclusao_id', 'data_inclusao_inicio', 'data_inclusao_fim']) ? 'show' : '' }}"
            data-parent="#accordion">
            <div class="card-body">
                <form action="{{ route('detentos.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control" placeholder="Parte do nome..."
                                    value="{{ request('nome') }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Matrícula</label>
                                <input type="text" name="matricula" class="form-control" placeholder="1.234.567"
                                    value="{{ request('matricula') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Guia/Tipo Inclusão</label>
                                <select name="tipo_inclusao_id" class="form-control">
                                    <option value="">Todos</option>
                                    @foreach ($tipoInclusao as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ request('tipo_inclusao_id') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Inclusão Início</label>
                                <input type="date" name="data_inclusao_inicio" class="form-control"
                                    value="{{ request('data_inclusao_inicio') }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>InclusãoFim</label>
                                <input type="date" name="data_inclusao_fim" class="form-control"
                                    value="{{ request('data_inclusao_fim') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-filter mr-1"></i> Filtrar
                            </button>
                            <a href="{{ route('detentos.index') }}" class="btn btn-default px-4 ml-2">
                                Limpar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
