<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "status",
        "image",
        "price",
        "discount_rate",
        "offer_id",
        "marka_id",
    ];
    public function getStatusAttribute(
        $value,
    ) {
        return (bool) $value;
    }
    protected $appends = [
        'amount_saved',
        'price_after_discount',
    ];
    public function offer()
    {
        return $this->belongsTo(
            Offer::class,
        );
    }
    public function marka()
    {
        return $this->belongsTo(
            Marka::class,
        );
    }
    public function getAmountSavedAttribute()
    {
        $discountRate = $this->discount_rate ?? 0;
        $price = $this->price ?? 0;
        if ($price && $discountRate) {
            $amountSaved = $price * $discountRate / 100;
            return number_format($amountSaved, 2);
        }
        return 0;
    }

    public function getPriceAfterDiscountAttribute()
    {
        $discountRate = $this->discount_rate ?? 0;
        $price = $this->price ?? 0;
        if ($price && $discountRate) {
            $priceAfterDiscount = $price - ($price * $discountRate / 100);
            return number_format($priceAfterDiscount, 2);
        }
        return $price;
    }
    public function getPriceBeforeDiscountAttribute()
    {
        return number_format($this->price, 2);
    }
}
