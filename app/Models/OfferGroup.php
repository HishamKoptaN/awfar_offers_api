<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OfferGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        "status",
        "name",
        "store_id",
        "image",
        "start_at",
        "end_at",
    ];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }
    protected $appends = [
        'days_remaining',
    ];
    public function getDaysRemainingAttribute()
    {
        $endAt = $this->end_at;

        if (!$endAt) {
            return 'No end date specified';
        }

        $days = now()->diffInDays(Carbon::parse($endAt), false);

        return $days >= 0 ? "$days" : "Offer expired";
    }
    public function store()
    {
        return $this->belongsTo(
            Store::class,
        );
    }
    public function offers()
    {
        return $this->hasMany(
            Offer::class,
        );
    }
}
