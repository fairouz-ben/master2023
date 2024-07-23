<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = "admin";
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'faculty_id',
        'role_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
 
    
    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id','id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }
    public function hasRole($role)
    {
        // Assuming you have a roles relationship or a role field
       // return $this->role === $role;
        // Or if you have a roles relationship as $this->belongsToMany(Role::class);
       // return $this->role->contains('name', $role);

        // Check if the user's role matches the given role
        return $this->role && $this->role->name === $role;
    }
}
