<?php

namespace App\Enums;

enum CouponType: string
{
    use Renderable;
    case FIXED = 'fixed';
    case PERCENT = 'percent';

    public static function options(): array
    {
        return [
            self::FIXED->value => 'Fixed',
            self::PERCENT->value => 'Percent',
        ];
    }
}
