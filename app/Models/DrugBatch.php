<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_id','supplier_id','batch_number','expired_at',
        'purchase_price','quantity','stock'
    ];

    public function drug() { return $this->belongsTo(Drug::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
}