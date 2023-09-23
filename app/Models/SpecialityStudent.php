<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialityStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'speciality_id',
        'order'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id','id');
    }
    public function speciality()
    {
        return $this->belongsTo(Speciality::class,'speciality_id','id');
    }
}
