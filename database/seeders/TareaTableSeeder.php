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
                'nombre' => 'Cambio de pasta térmica',
                'descripcion' => 'Realizar el cambio de pasta térmica en el procesador para mejorar la disipación de calor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
