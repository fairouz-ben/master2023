<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_id',
        'title',
        'title_fr',
        'level',
        'is_active',
        'number_available',
      
    ];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function speciality_students()
    {
        return $this->hasMany(SpecialityStudent::class,'speciality_id','id');
    }
    public function SpLicense_SpMaster()
    {
        return $this->hasMany(SpLicense_SpMaster::class,'speciality_id','id');
    }
}
