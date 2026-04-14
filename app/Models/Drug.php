<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','function','side_effect','code',
        'category','brand','dose','group','form','retail_price', 'stock', 'price', 'clinic_id'
    ];

    public function clinic() { return $this->belongsTo(Clinic::class); }
}