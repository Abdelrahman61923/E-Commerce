<?php

namespace App\Enums;

enum ProductStockStatus: string
{
    case INSTOCK = 'instock';
    case OUTOFSTOCK = 'outofstock';
}
