<?php

namespace App\Models\Maintenance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenusModel extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = [
        'name',
        'link'
    ];
}
