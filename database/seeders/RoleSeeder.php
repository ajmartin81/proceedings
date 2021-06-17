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

        // Añadimos los permisos
        Permission::create(['name' => 'admin'])->syncRoles([$abogado]);
        Permission::create(['name' => 'proceeding.add'])->syncRoles([$abogado]);
        Permission::create(['name' => 'proceeding.edit'])->syncRoles([$abogado]);
        Permission::create(['name' => 'user.add'])->syncRoles([$abogado]);
        Permission::create(['name' => 'user.edit'])->syncRoles([$abogado]);

        Permission::create(['name' => 'status.edit'])->syncRoles([$abogado, $colaborador]);

        Permission::create(['name' => 'event.add'])->syncRoles([$abogado, $colaborador]);
        Permission::create(['name' => 'event.edit'])->syncRoles([$abogado, $colaborador]);
        Permission::create(['name' => 'event.destroy'])->syncRoles([$abogado]);

        Permission::create(['name' => 'annotation.add'])->syncRoles([$abogado, $colaborador]);
        Permission::create(['name' => 'annotation.edit'])->syncRoles([$abogado, $colaborador]);
        Permission::create(['name' => 'annotation.destroy'])->syncRoles([$abogado]);
    }
}
