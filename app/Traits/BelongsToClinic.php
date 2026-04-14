<?php

namespace App\Traits;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

trait BelongsToClinic
{
    protected static function bootBelongsToClinic()
    {
        static::creating(function ($model) {
            if (session()->has('clinic_id')) {
                $model->clinic_id = session()->get('clinic_id');
            }
        });

        static::addGlobalScope('clinic', function (Builder $builder) {
            if (session()->has('clinic_id')) {
                $builder->where('clinic_id', session()->get('clinic_id'));
            }
        });
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
