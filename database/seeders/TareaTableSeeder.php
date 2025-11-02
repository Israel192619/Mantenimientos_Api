<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TareaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tareas')->insert([
            [
                'nombre' => 'Revisión de Servidor',
                'descripcion' => 'Realizar una revisión completa del servidor principal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
