<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'store_id',
        'category_id',
        'url',
        'description',
        'is_work',
        'status',
    ];
    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }
    protected $casts = [
        'is_work' => 'boolean',
    ];
    public function getIsWorkAttribute($value)
    {
        return (bool) $value;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function scopeByCityId(
        $query,
        $cityId,
    ) {
        return $query->whereHas(
            'store',
            function ($query) use ($cityId) {
                $query->where(
                    'city_id',
                    $cityId,
                );
            },
        );
    }
}
