<?php

namespace Database\Seeders;

use App\Models\Maintenance\RolesModel;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolesModel::create(['name' => 'Administrador Sistema']);
        RolesModel::create(['name' => 'Administrador General']);
        RolesModel::create(['name' => 'Responsable Finanzas']);
        RolesModel::create(['name' => 'Responsable Área']);

    }
}
