<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        "status",
        'name',
        'category_id',
        'image',
    ];
    protected $casts = [
        'id' => 'integer',
        "status" => 'boolean',
        'category_id' => 'integer',
        'name' => 'string',
        'image' => 'string',
    ];
    public function getStatusAttribute(
        $value,
    ) {
        return (bool) $value;
    }
    public function category()
    {
        return $this->belongsTo(
            Category::class,
        );
    }
    public function subCategoryItems()
    {
        return $this->hasMany(
            Marka::class,
        );
    }
    public function stores()
    {
        return $this->hasMany(
            Store::class,
        );
    }
}
