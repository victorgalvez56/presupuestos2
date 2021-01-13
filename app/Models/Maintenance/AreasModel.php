<?php

namespace App\Models\Maintenance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreasModel extends Model
{
    use HasFactory;
    protected $table = 'areas';

    protected $fillable = [
        'name',
        'status',
        'representative_id',
    ];
}
