<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('matricula')->unique(); // Matrícula única
            $table->date('data_inclusao');
            $table->date('data_solicitacao');
            $table->boolean('saiu_guia')->default(false);
            $table->string('numero_guia')->nullable();
            $table->string('unidade_destino')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detentos');
    }
};
