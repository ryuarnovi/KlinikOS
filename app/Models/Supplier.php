<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact', 'address', 'clinic_id'];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}