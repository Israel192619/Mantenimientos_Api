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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['preventivo', 'correctivo']);
            $table->date('fecha_programada')->nullable();
            $table->date('fecha_real')->nullable();
            $table->foreignId('equipo_id')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('tecnico_id')->nullable()->constrained('tecnicos')->onDelete('set null');
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['pendiente', 'en proceso', 'completado', 'cancelado'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
