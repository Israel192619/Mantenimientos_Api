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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->string('tipo');
            $table->string('marca');
            $table->foreignId('organization_id')->nullable()->constrained('organizations')->nullOnDelete();
            $table->string('sistema_operativo');
            $table->string('procesador');
            $table->string('memoria_ram');
            $table->string('almacenamiento');
            $table->date('ultimo_mantenimiento')->nullable();
            $table->date('proximo_mantenimiento')->nullable();
            $table->enum('estado', ['activo', 'en reparación', 'fuera de servicio'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
