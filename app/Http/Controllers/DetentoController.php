<?php

namespace App\Http\Controllers;

use App\Models\Detento;
use App\Models\TipoInclusao;
use Illuminate\Http\Request;

class DetentoController extends Controller
{

    public function index()
    {
        $detentos = Detento::with('tipoInclusao')
            ->where('ativo', 1)
            ->orderBy('nome')->paginate(10);
        $tipoInclusao = TipoInclusao::orderBy('descricao')->get();
        return view('detentos.index', compact('detentos', 'tipoInclusao'));
    }

    public function create()
    {
        $tipoInclusao = TipoInclusao::orderBy('descricao')->get();
        return view('detentos.create', compact('tipoInclusao'));
    }

    public function store(Request $request)
    {
        // Validação simples
        $request->validate([
            'nome' => 'required',
            'matricula' => 'required|unique:detentos',
            'data_inclusao' => 'required|date',
        ]);

        Detento::create($request->all());

        return redirect()->route('detentos.index')
            ->with('success', 'Detento cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $detento = Detento::findOrFail($id);
        $tipoInclusao = TipoInclusao::orderBy('descricao')->get();
        return view('detentos.edit', compact('detento', 'tipoInclusao'));
    }

    public function update(Request $request, $id)
    {
        $detento = Detento::findOrFail($id);

        // Atualiza os dados
        $detento->update($request->all());

        return redirect()->route('detentos.index')
            ->with('success', 'Cadastro atualizado!');
    }

    public function destroy($id)
    {
        $detento = Detento::findOrFail($id);

        // Alterando para inativo em vez de excluir
        $detento->ativo = false;
        $detento->save(); // Salvando a alteração no banco de dados

        return redirect()->route('detentos.index')
            ->with('success', 'Detento inativado com sucesso!');
    }

    public function buscarPorMatricula(Request $request)
    {
        $matricula = $request->get('matricula');

        $detento = Detento::where('matricula', $matricula)->first();

        if ($detento) {
            return response()->json([
                'success' => true,
                'nome' => $detento->nome,
            ]);
        }

        return redirect()->back();
    }
}
