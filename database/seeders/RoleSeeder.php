<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creamos los roles necesarios
        $abogado = Role::create(['name' => 'Abogado']);
        $cliente = Role::create(['name' => 'Cliente']);
        $colaborador = Role::create(['name' => 'Colaborador']);

        // AÑadinos los permisos
        
    }
}
