<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [

        'name',
        'code',
        'description'
    ];

    public function usersadmins()
    {
        return $this->hasMany(Admin::class, 'role_id', 'id');
    }
}
