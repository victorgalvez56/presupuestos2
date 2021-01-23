<?php

namespace Database\Seeders;

use App\Models\Maintenance\MenusModel;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenusModel::create(['name' => 'Dashboard', 'link' => 'home']);
        MenusModel::create(['name' => 'Areas', 'link' => 'areas.index']);
        MenusModel::create(['name' => 'Areas', 'link' => 'areas.create']);
        MenusModel::create(['name' => 'Areas', 'link' => 'areas.edit']);
        MenusModel::create(['name' => 'Areas', 'link' => 'areas.delete']);
        MenusModel::create(['name' => 'Batchs', 'link' => 'batchs']);
        MenusModel::create(['name' => 'Users', 'link' => 'users']);

    }
}
