<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable = [
        //'name_ar',
       // 'name_fr',
       // 'code',
        'speciality_max_choice',
        'is_active',
        'show_result',
        'inscription_close_date',
        'update_close_date',
        'treatment_close_date',
        'recoure_close_date'
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

    public function inscription_close_is_valid(): bool
    {
        return ($this->inscription_close_date >= date_format(now(), 'Y-m-d')); //now();
    }
    public function update_is_valid():bool
    {
    
        return $this->update_close_date >=  date_format(now(), 'Y-m-d'); //now();
    }
    public function treatment_is_valid():bool
    {
    
        return $this->treatment_close_date >=  date_format(now(), 'Y-m-d'); //now();
    }
    /////
    public function getInscriptionCloseIsValidAttribute(): bool
    {
        return ($this->inscription_close_date >= date_format(now(), 'Y-m-d'));
    }
    public function getUpdateIsValidAttribute():bool
    {
    
        return $this->update_close_date >=  date_format(now(), 'Y-m-d'); //now();
    }
    public function getTreatmentIsValidAttribute():bool
    {
    
        return $this->treatment_close_date >=  date_format(now(), 'Y-m-d'); //now();
    }
    public function getRecoureIsValidAttribute():bool
    {
    
        return $this->recoure_close_date >=  date_format(now(), 'Y-m-d'); //now();
    }
    
}
