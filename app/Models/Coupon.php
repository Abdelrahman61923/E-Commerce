<?php

namespace App\Models;

use App\Enums\CouponType;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'type', 'value', 'cart_value', 'expiry_date',
    ];

    protected $casts = [
        'type' => CouponType::class,
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }
}
