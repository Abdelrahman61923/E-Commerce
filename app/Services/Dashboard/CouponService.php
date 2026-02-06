<?php

namespace App\Services\Dashboard;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Model;

class CouponService extends AbstractService
{
    protected function model(): Model
    {
        return new Coupon();
    }
}
