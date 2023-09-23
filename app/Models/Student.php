<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nom_ar',
        'nom_fr',
        'prenom_ar',
        'prenom_fr',
        'date_nais',
        'phone',
        'mat_bac',
        'year_bac',
        
        'code',
        'city_bac',
        'univ_origine',
        'licence',
        'licence_type',
        'faculty_id',
        'department_id',
        'file_path',
        'S1',
        'S2',
        'S3',
        'S4',
        'S5',
        'S6',
        'oriented_to_speciality',
        'annee_doublon',
        'nb_dette',
        'nb_rattrapage',
        'moy_classement',
        'special_1',
        'special_2',
        'special_3',
        'special_4',
        'motif',
        'etat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id','id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function speciality_students()
    {
        return $this->hasMany(SpecialityStudent::class,'student_id','id');
    }
   /* public function speciality()
    {
        return $this->hasOne(Speciality::class,'student_id','id');
    }*/
}
