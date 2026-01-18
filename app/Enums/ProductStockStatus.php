<?php

namespace App\Enums;

enum ProductStockStatus: string
{
    use Renderable;
    case INSTOCK = 'instock';
    case OUTOFSTOCK = 'outofstock';

    public static function options(): array
    {
        return [
            self::INSTOCK->value => 'In Stock',
            self::OUTOFSTOCK->value => 'Out Of Stock',
        ];
    }
}
