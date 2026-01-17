<?php

namespace App\Enums;

enum ProductStockStatus: string
{
    use Renderable;
    case INSTOCK = 'instock';
    case OUTOFSTOCK = 'outofstock';
}
