<?php

namespace App\Models\Maintenance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthsModel extends Model
{
    use HasFactory;

    protected $table = 'months';
    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'status'
    ];
}
