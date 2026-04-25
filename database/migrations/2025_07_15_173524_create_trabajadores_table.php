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
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('puesto');
            $table->string('telefono');
            $table->string('contacto_emergencia');
            $table->string('enfermedad_cronica');
            $table->string('planta');
            $table->string('brigada')->nullable()->default('Sin Brigada');
            $table->string('comision')->nullable()->default('Sin Comisión');
            $table->string('fotografia')->nullable()->default('/img/user.webp');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};
