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

    public function usadminsers(){
        return $this->hasMany(Admin::class,'role_id','id');
    }
}
