<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marka extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'name',
        'sub_category_id',
    ];
    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }
    public function subCategory()
    {
        return $this->belongsTo(
            SubCategory::class,
        );
    }
    public function products()
    {
        return $this->hasMany(
            Product::class,
        );
    }
}
