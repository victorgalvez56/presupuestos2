<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintenance\AreasModel;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AreasModel::create(['name' => 'PS','representative_id' => '3']);
        AreasModel::create(['name' => 'ES','representative_id' => '4']);
        AreasModel::create(['name' => 'MS','representative_id' => '5']);
        AreasModel::create(['name' => 'HS','representative_id' => '6']);
        AreasModel::create(['name' => 'DESARROLLO HUMANO','representative_id' => '7']);
        AreasModel::create(['name' => 'ADMISIÓN','representative_id' => '8']);
        AreasModel::create(['name' => 'INTERNACIONALIZACIÓN','representative_id' => '9']);
        AreasModel::create(['name' => 'HP','representative_id' => '8','representative_id' => '10']);
        AreasModel::create(['name' => 'IMAGENES Y RELACIONES PÚBLICAS','representative_id' => '11']);
        AreasModel::create(['name' => 'FINANZAS','representative_id' => '12']);
        AreasModel::create(['name' => 'SERVICIOS BÁSICOS','representative_id' => '12']);;
        AreasModel::create(['name' => 'MANTENIMIENTO','representative_id' => '13']);
        AreasModel::create(['name' => 'LOGÍSTICA','representative_id' => '13']);
        AreasModel::create(['name' => 'SEGURIDAD INTERNA','representative_id' => '14']);
        AreasModel::create(['name' => 'SISTEMAS','representative_id' => '15']);

    }
}
