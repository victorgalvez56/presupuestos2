<?php

namespace Database\Seeders;

use App\Models\Maintenance\MonthsModel;
use Illuminate\Database\Seeder;

class MonthsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MonthsModel::create(['name' => 'Enero', 'date_start' => '2000/01/01', 'date_end' => '2000/01/31']);
        MonthsModel::create(['name' => 'Febrero', 'date_start' => '2000/02/01', 'date_end' => '2000/02/29']);
        MonthsModel::create(['name' => 'Marzo', 'date_start' => '2000/03/01', 'date_end' => '2000/03/31']);
        MonthsModel::create(['name' => 'Abril', 'date_start' => '2000/04/01', 'date_end' => '2000/04/30']);
        MonthsModel::create(['name' => 'Mayo', 'date_start' => '2000/05/01', 'date_end' => '2000/05/31']);
        MonthsModel::create(['name' => 'Junio', 'date_start' => '2000/06/01', 'date_end' => '2000/06/30']);
        MonthsModel::create(['name' => 'Julio', 'date_start' => '2000/07/01', 'date_end' => '2000/07/31']);
        MonthsModel::create(['name' => 'Agosto', 'date_start' => '2000/08/01', 'date_end' => '2000/08/31']);
        MonthsModel::create(['name' => 'Septiembre', 'date_start' => '2000/09/01', 'date_end' => '2000/09/30']);
        MonthsModel::create(['name' => 'Octubre', 'date_start' => '2000/10/01', 'date_end' => '2000/10/31']);
        MonthsModel::create(['name' => 'Noviembre', 'date_start' => '2000/11/01', 'date_end' => '2000/11/30']);
        MonthsModel::create(['name' => 'Diciembre', 'date_start' => '2000/12/01', 'date_end' => '2000/12/31']);
    }
}
