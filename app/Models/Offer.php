<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{

    use HasFactory;

    protected $fillable = [
        "status",
        "store_id",
        "offer_group_id",
        "image",
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    public function offerGroup()
    {
        return $this->belongsTo(
            OfferGroup::class,
        );
    }
    public function getStatusAttribute(
        $value,
    ) {
        return (bool) $value;
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
    public function subCategory()
    {
        return $this->belongsTo(
            SubCategory::class,
        );
    }

    public function getOfferDetails()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'sub_category' => $this->subCategory ? [
                'id' => $this->subCategory->id,
                'category_id' => $this->subCategory->category_id,
            ] : null,
            'store' => $this->store ? [
                'id' => $this->store->id,
                'name' => $this->store->name,
                'image' => $this->store->image,
                'offers_count' => $this->store->storeOffersCount()
            ] : null,
        ];
    }
}
