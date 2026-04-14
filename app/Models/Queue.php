<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'patient_id',
        'type', // pendaftaran, pemeriksaan, farmasi, kasir
        'status', // waiting, in_progress, done, referred
        'referral_id', // nullable, jika dirujuk
        'position',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
