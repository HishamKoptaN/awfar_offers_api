<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $fillable = [
        'name',
        'flag',
        'status',
    ];
    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }
}
