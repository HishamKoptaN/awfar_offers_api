<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'status',
        'online_offline',
        'first_name',
        'last_name',
        'password',
        'email',
        'image',
        'address',
        'phone',
    ];


    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
    public function createdDate(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => $this->created_at ? $this->created_at->format('Y-m-d') : null,
        );
    }
    public function upgradedDate(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => $this->upgraded_at ? $this->upgraded_at->format('Y-m-d H:i') : null,
        );
    }
    public function refer()
    {
        return $this->belongsTo(User::class, 'refered_by');
    }
    public function referrals()
    {
        return $this->hasMany(User::class, 'refered_by');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
