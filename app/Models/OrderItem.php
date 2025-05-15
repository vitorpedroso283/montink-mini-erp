<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_variation_id',
        'quantity',
        'unit_price'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function variation(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class);
    }

    //accessors
    public function getUnitPriceFormattedAttribute(): string
    {
        return 'R$ ' . number_format($this->unit_price / 100, 2, ',', '.');
    }
}
