<?php

namespace App\Enums;

enum CouponType: string
{
    use Renderable;
    case FIXED = 'fixed';
    case PERCENT = 'percent';
}
