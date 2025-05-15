<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'email',
        'cep',
        'address',
        'subtotal',
        'freight',
        'total',
        'coupon_code',
        'status'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    //accessors
    public function getSubtotalFormattedAttribute(): string
    {
        return 'R$ ' . number_format($this->subtotal / 100, 2, ',', '.');
    }

    public function getFreightFormattedAttribute(): string
    {
        return 'R$ ' . number_format($this->freight / 100, 2, ',', '.');
    }

    public function getTotalFormattedAttribute(): string
    {
        return 'R$ ' . number_format($this->total / 100, 2, ',', '.');
    }
}
