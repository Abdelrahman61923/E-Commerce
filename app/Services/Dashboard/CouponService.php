<?php

namespace App\Services\Dashboard;

use App\Models\Coupon;

class CouponService
{
    public function getAll($perPage = 10)
    {
        return Coupon::latest()->paginate($perPage);
    }

    public function add(array $data)
    {
        return Coupon::create($data);
    }

    public function update(Coupon $coupon, array $data)
    {
        $coupon->update($data);
        return $coupon;
    }

    public function delete(Coupon $coupon)
    {
        return $coupon->delete();
    }
}
