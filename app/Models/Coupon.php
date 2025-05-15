<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'discount_percent', 'min_value', 'valid_until'];

    protected $dates = ['valid_until'];
    

    public function setDiscountPercentAttribute($value)
    {
        $this->attributes['discount_percent'] = (int) round($value * 100);
    }
}