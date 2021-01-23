<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetsModel extends Model
{
    use HasFactory;
    protected $table = 'budgets';

    protected $fillable = [
        'price_dollar',
        'total_budget_soles',
        'total_budget_dollar',
        'status',
        'representative_id',
    ];
}
