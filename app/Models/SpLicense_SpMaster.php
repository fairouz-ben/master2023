<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpLicense_SpMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'License_specialty_id',
        'speciality_id',
        
    ];

    public function license_specialty()
    {
        return $this->belongsTo(License_specialty::class,'license_specialties','id');
    }
    public function speciality()
    {
        return $this->belongsTo(Speciality::class,'speciality_id','id');
    }
}
