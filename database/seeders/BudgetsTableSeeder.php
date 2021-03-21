<?php

namespace Database\Seeders;

use App\Models\Budgets\BudgetsModel;
use Illuminate\Database\Seeder;

class BudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BudgetsModel::create(['total_budget_soles' => '0', 'total_budget_dollar' => '0','representative_id' => '1']);
    }
}
