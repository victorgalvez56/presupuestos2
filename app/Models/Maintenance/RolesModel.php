<?php

namespace App\Models\Maintenance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'status'
    ];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
