<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offer;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }
    public function subCategories()
    {
        return $this->hasMany(
            SubCategory::class,
        );
    }
    public function offerGroups()
    {
        return $this->hasMany(
            OfferGroup::class,
        );
    }
    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
    public function subCategoryOffers()
    {
        return $this->hasManyThrough(
            Offer::class, // الجدول الهدف (العروض)
            SubCategory::class, // الجدول الوسيط (التصنيفات الفرعية)
            'category_id', // المفتاح الأجنبي في SubCategory الذي يشير إلى Category
            'sub_category_id', // المفتاح الأجنبي في Offer الذي يشير إلى SubCategory
            'id', // المفتاح الأساسي في Category
            'id'  // المفتاح الأساسي في SubCategory
        );
    }
    public function scopeByCityId(
        $query,
        $cityId,
    ) {
        return $query->whereHas(
            'coupons.store',
            function ($query) use (
                $cityId,
            ) {
                $query->where(
                    'city_id',
                    $cityId,
                );
            },
        );
    }
}
