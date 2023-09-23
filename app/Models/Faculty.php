<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable = [
       
    ];
    public function departments(){
        return $this->hasMany(Department::class,'faculty_id','id');
    }
   
    public function users(){
        return $this->hasMany(User::class,'faculty_id','id');
    }
    public function admins(){
        return $this->hasMany(Admin::class,'faculty_id','id');
    }
}
