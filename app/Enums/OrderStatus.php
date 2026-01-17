<?php

namespace App\Enums;

enum OrderStatus: string
{
    use Renderable;
    case ORDERED = 'ordered';
    case DELIVERED = 'delivered';
    case CANCELED = 'canceled';
}
