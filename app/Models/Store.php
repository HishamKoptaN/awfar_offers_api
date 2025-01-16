<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $table = 'stores';
    protected $fillable = [
        "status",
        'id',
        'name',
        'image',
        'city_id',
        'place',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }
    // protected $appends = [
    //     'offers_count',
    // ];
    // public function subCategoryItem()
    // {
    //     return $this->hasMany(SubCategoryItem::class, 'store_id');
    // }
    public function city()
    {
        return $this->belongsTo(
            City::class,
        );
    }

    public function offerGroups()
    {
        return $this->hasMany(OfferGroup::class, 'store_id');
    }
    public function offers()
    {
        return $this->hasMany(
            Offer::class,
        );
    }

    public function coupons()
    {
        return $this->hasMany(
            Offer::class,
        );
    }


    public function storeOffersCount()
    {
        return $this->offers()->count();
    }
    public function getStoreOffers()
    {
        return $this->offers()->get();
    }
    public function getOffersCountAttribute()
    {
        return $this->offers()->count();
    }
    public function getStoreWithOffers()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'place' => $this->place,
            'offers_count' => $this->offers_count,
            'offers' => $this->offers->map->getOfferDetails(),
        ];
    }
    public function products()
    {
        return $this->hasManyThrough(
            Product::class,    // نموذج المنتجات
            OfferGroup::class, // نموذج مجموعات العروض
            'store_id',        // المفتاح الأجنبي في جدول offer_groups
            'offer_group_id',  // المفتاح الأجنبي في جدول products
            'id',              // المفتاح الأساسي في جدول stores
            'id'               // المفتاح الأساسي في جدول offer_groups
        );
    }
    public function scopeByCityId(
        $query,
        $cityId,
    ) {
        return $query->whereHas(
            'store',
            function (
                $query,
            ) use (
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
