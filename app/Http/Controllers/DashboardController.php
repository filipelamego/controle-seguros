<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detento;

class DashboardController extends Controller
{
    public function index()
    {
        // Contagens
        $totalDetentos = Detento::where('ativo', 1)->count();
        $guiasEmitidas = Detento::where('saiu_guia', 1)
            ->where('ativo', 1)
            ->count();
        $guiasAguardando = Detento::where('saiu_guia', 0)
            ->where('ativo', 1)
            ->count();
        $detentosGuiasEmitidas = Detento::where('saiu_guia', 1)
            ->where('ativo', 1)
            ->orderBy('data_solicitacao', 'asc')
            ->get();
        $detentosAguardandoGuia = Detento::where('saiu_guia',0)
            ->where('ativo', 1)
            ->orderBy('data_solicitacao', 'asc')
            ->get();

        // Retorna a view com os dados
        return view('dashboard.index', compact('totalDetentos', 'guiasEmitidas', 'guiasAguardando', 'detentosGuiasEmitidas', 'detentosAguardandoGuia'));
    }
}
