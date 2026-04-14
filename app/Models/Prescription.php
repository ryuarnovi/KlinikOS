<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'patient_name', 'status', 'confirmed_by', 'total', 'clinic_id'];

    public function items() { return $this->hasMany(PrescriptionItem::class); }
    public function doctor() { return $this->belongsTo(User::class, 'doctor_id'); }
    public function kasir() { return $this->belongsTo(User::class, 'confirmed_by'); }
    public function clinic() { return $this->belongsTo(Clinic::class); }
}
