<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id', 'patient_id', 'amount', 'status', 'payment_method', 'reference', 'due_date', 'paid_at'
    ];

    public function patient() { return $this->belongsTo(Patient::class); }
}
