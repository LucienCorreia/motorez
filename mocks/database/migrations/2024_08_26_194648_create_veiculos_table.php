<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('marca');
            $table->string('modelo');
            $table->string('ano');
            $table->string('versao');
            $table->string('cor');
            $table->string('quilometragem');
            $table->string('tipo_combustivel');
            $table->string('cambio');
            $table->string('portas');
            $table->string('preco_venda');
            $table->string('ultima_atualizacao');
            $table->string('opcionais');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
