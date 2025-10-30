<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TecnicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tecnicos')->insert([
            [
                'nombre' => 'Juan',
                'primero_apellido' => 'Pérez',
                'segundo_apellido' => 'Gómez',
                'especialidad' => 'Redes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'María',
                'primero_apellido' => 'López',
                'segundo_apellido' => 'Martínez',
                'especialidad' => 'Hardware',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Carlos',
                'primero_apellido' => 'Sánchez',
                'segundo_apellido' => null,
                'especialidad' => 'Software',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
