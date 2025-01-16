<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationToken extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_id',
        'city_id',
        'fcm_token',
    ];
    public function city()
    {
        return $this->belongsTo(
            City::class,
        );
    }
}
