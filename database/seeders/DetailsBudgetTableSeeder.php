<?php

namespace Database\Seeders;

use App\Models\Budgets\DetailsBudgetModel;
use Illuminate\Database\Seeder;

class DetailsBudgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailsBudgetModel::create([
            'price_dollar' => '0',
            'quantity' => '0',
            'description' => '0',
            'unit_price'=> '0',
            'total_soles'=> '0',
            'total_dollars'=> '0',
            'month_id'=> '0',

            'batch_id'=> '1',
            'budget_id'=> '1',
            'budget_id'=> '1'

            ]);

    }
}
