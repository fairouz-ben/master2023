<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_fr',
        'code',
        'speciality_max_choice',
        'is_active',
        'faculty_id',
        'show_result',
        'treatment_stat',
        
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id','id');
    }
    public function specialities()
    {
        return $this->hasMany(Speciality::class,'department_id','id');
    }
    public function students()
    {
        return $this->hasMany(Student::class,'department_id','id');
    }
}
