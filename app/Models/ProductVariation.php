<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = ['product_id', 'name', 'sku', 'price'];

    protected static function booted(): void
    {
        static::creating(function ($variation) {
            if (empty($variation->sku)) {
                $variation->sku = strtoupper('SKU-' . uniqid());
            }
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    //accessors
    public function getPriceFormattedAttribute(): string
    {
        return 'R$ ' . number_format($this->price / 100, 2, ',', '.');
    }

    //mutators
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = (int) round($value * 100);
    }
}
