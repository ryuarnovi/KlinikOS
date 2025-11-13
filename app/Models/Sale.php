<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no', 'sold_at', 'total', 'prescription_id'
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
