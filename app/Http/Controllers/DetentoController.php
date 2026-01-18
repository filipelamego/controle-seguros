<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDetentoRequest;
use App\Models\Detento;
use App\Services\DetentoService;
use Illuminate\Http\Request;

class DetentoController extends Controller
{
    protected $detentoService;

    public function __construct(DetentoService $detentoService)
    {
        $this->detentoService = $detentoService;
    }

    public function index(Request $request)
    {
        $filters = $request->all();

        $detentos = $this->detentoService->getListagemPaginada($filters);
        $tipoInclusao = $this->detentoService->getTiposInclusao();

        return view('detentos.index', compact('detentos', 'tipoInclusao'));
    }

    public function create()
    {
        $tipoInclusao = $this->detentoService->getTiposInclusao();

        return view('detentos.create', compact('tipoInclusao'));
    }

    public function store(StoreDetentoRequest $request)
    {
        // O uso do $request->validated() é mais seguro que o all()
        $this->detentoService->store($request->validated());

        toastr()->success('Detento cadastrado com sucesso!', 'Concluído');

        return redirect()->route('detentos.index');
    }

    public function edit($id)
    {
        $detento = Detento::findOrFail($id);
        $tipoInclusao = $this->detentoService->getTiposInclusao();

        return view('detentos.edit', compact('detento', 'tipoInclusao'));
    }

    public function update(Request $request, $id)
    {
        // Para o update, você poderia criar um UpdateDetentoRequest também
        $this->detentoService->update($id, $request->all());

        toastr()->success('Detento atualizado com sucesso!', 'Concluído');
        return redirect()->route('detentos.index');
    }

    public function destroy($id)
    {
        $this->detentoService->inativar($id);

        toastr()->success('Detento excluído com sucesso!', 'Concluído');
        return redirect()->route('detentos.index');
    }

    public function buscarPorMatricula(Request $request)
    {
        $detento = $this->detentoService->buscarPorMatricula($request->get('matricula'));

        if ($detento) {
            return response()->json([
                'success' => true,
                'nome' => $detento->nome,
            ]);
        }

        return response()->json(['success' => false], 404);
    }
}
