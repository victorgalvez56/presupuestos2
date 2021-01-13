<?php

namespace App\Models\Maintenance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchsModel extends Model
{
    use HasFactory;
    protected $table = 'batchs';
    protected $fillable = [
        'name',
        'area_id'
    ];
}
