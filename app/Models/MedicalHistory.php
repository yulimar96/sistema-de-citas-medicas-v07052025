<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date',
        'diagnosis',
        'treatment',
        'status',
    ];

    // Relaciones
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function person()
    {
        return $this->belongsTo(Persons::class); 
    }
        public function user()
    {
        return $this->belongsTo(User::class); 
    }
  
public function doctor()
{
    return $this->belongsTo(Employee::class, 'doctor_id')->with('speciality');
}
}
