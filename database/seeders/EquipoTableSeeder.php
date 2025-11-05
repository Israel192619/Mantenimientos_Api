<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('equipos')->insert([
            [
                'codigo' => 'EQP-001',
                'nombre' => 'laptop de prueba',
                'tipo' => 'Laptop',
                'marca' => 'Dell',
                'organization_id' => 1,
                'sistema_operativo' => 'Linux',
                'procesador' => 'Intel Xeon',
                'memoria_ram' => '64GB',
                'almacenamiento' => '2TB SSD',
                'ultimo_mantenimiento' => '2024-01-15',
                'proximo_mantenimiento' => '2024-07-15',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
