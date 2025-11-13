<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    use HasFactory;

    protected $fillable = ['prescription_id', 'drug_id', 'quantity', 'price_each'];

    public function prescription() { return $this->belongsTo(Prescription::class); }
    public function drug() { return $this->belongsTo(Drug::class); }
}
