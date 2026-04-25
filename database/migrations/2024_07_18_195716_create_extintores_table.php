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
        Schema::create('extintores', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('planta');
            $table->string('ubicacion');
            $table->string('agente_extintor');
            $table->string('capacidad');
            $table->string('tipo');
            $table->string('ultima_recarga')->nullable()->default('N/A');
            $table->string('proxima_recarga')->nullable()->default('N/A');
            $table->string('ultimo_mantenimiento')->nullable()->default('N/A');
            $table->string('proximo_mantenimiento')->nullable()->default('N/A');
            $table->string('ultima_prueba')->nullable()->default('N/A');
            $table->string('proxima_prueba')->nullable()->default('N/A');
            $table->string('letrero');
            $table->string('fecha_fabricacion');
            $table->string('vencimiento_antiguedad');
            $table->string('estado_actual');
            $table->string('observaciones')->nullable()->default('Sin Observaciones');
            $table->string('foto1');
            $table->string('foto2');
            $table->string('foto3');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extintores');
    }
};
