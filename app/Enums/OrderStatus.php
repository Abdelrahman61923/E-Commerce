<?php

namespace App\Enums;

enum OrderStatus: string
{
    use Renderable;
    case ORDERED = 'ordered';
    case DELIVERED = 'delivered';
    case CANCELED = 'canceled';

    public static function options(): array
    {
        return [
            self::ORDERED->value => 'Ordered',
            self::DELIVERED->value => 'Delivered',
            self::CANCELED->value => 'Canceled',
        ];
    }
}
