<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organizations')->insert([
            [
                'nombre' => 'Tech Solutions',
                'descripcion' => 'Empresa dedicada a soluciones tecnológicas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Innovatech',
                'descripcion' => 'Innovación y tecnología para el futuro.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Global Tech',
                'descripcion' => 'Líder mundial en servicios tecnológicos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'NextGen IT',
                'descripcion' => 'Soluciones de TI de próxima generación.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'FutureTech',
                'descripcion' => 'Tecnología para un futuro mejor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
