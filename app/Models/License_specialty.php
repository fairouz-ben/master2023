<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License_specialty extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_id',
        'title',
        'title_fr'
      
    ];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    
    public function SpLicense_SpMaster()
    {
        return $this->hasMany(SpLicense_SpMaster::class,'License_specialty_id','id');
    }
}
