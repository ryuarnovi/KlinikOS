<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    use HasFactory;

    protected $fillable = ['drug_batch_id','type','quantity','note'];

    public function batch() { return $this->belongsTo(DrugBatch::class, 'drug_batch_id'); }
}