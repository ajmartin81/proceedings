<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();

        $admin->name = "Administrador";
        $admin->surname = "";
        $admin->email = "administrador@expedientes.test";
        $admin->phone = "555555555";
        $admin->nif = "12345678L";
        $admin->address = "C/Expediente S/N";
        $admin->password = '$2y$10$pFtdxWQX9iTyjvZELymCseuhPxl//tgdq5vN0c97tLfRRFtODS3Iu'; // 12345678
        $admin->assignRole('Abogado');

        $admin->save();

        $coworker = new User();

        $coworker->name = "Colaborador";
        $coworker->surname = "";
        $coworker->email = "colaborador@expedientes.test";
        $coworker->phone = "555555555";
        $coworker->nif = "12345679L";
        $coworker->address = "C/Expediente S/N";
        $coworker->password = '$2y$10$pFtdxWQX9iTyjvZELymCseuhPxl//tgdq5vN0c97tLfRRFtODS3Iu'; // 12345678
        $coworker->assignRole('Colaborador');

        $coworker->save();

        $client = new User();

        $client->name = "Cliente";
        $client->surname = "";
        $client->email = "cliente@expedientes.test";
        $client->phone = "555555555";
        $client->nif = "12345670L";
        $client->address = "C/Expediente S/N";
        $client->password = '$2y$10$pFtdxWQX9iTyjvZELymCseuhPxl//tgdq5vN0c97tLfRRFtODS3Iu'; // 12345678
        $client->assignRole('Cliente');

        $client->save();
    }
}
