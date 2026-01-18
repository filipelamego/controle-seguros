<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetentoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/detentos', [DetentoController::class, 'index'])->name('detentos.index');
    // Rota para abrir o formulário de cadastro
    Route::get('/detentos/cadastrar-guias', [DetentoController::class, 'create'])->name('detentos.create');

    // Rota para quando você clicar em "Salvar" (vamos usar depois)
    Route::post('/detentos/salvar', [DetentoController::class, 'store'])->name('detentos.store');

    // Edição (precisa do ID do detento na URL)
    Route::get('/detentos/{id}/editar', [DetentoController::class, 'edit'])->name('detentos.edit');
    Route::put('/detentos/{id}', [DetentoController::class, 'update'])->name('detentos.update');

    // Exclusão
    Route::delete('/detentos/{id}', [DetentoController::class, 'destroy'])->name('detentos.destroy');

    // Rota para buscar o preso e evitar duplicação
    Route::get('/detentos/buscar', [DetentoController::class, 'buscarPorMatricula'])->name('detentos.buscar');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
