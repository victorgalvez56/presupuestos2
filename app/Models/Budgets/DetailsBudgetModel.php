<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsBudgetModel extends Model
{
    use HasFactory;
    protected $table = 'details_budgets';

    protected $fillable = [
        'quantity',
        'description',
        'unit_price',
        'total_soles',
        'total_dollars',
        'month_id',
        'batch_id',
        'budget_id',
        'status',
    ];
}
