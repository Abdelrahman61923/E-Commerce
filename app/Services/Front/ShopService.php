<?php

namespace App\Services\Front;

use App\Models\Product;

class ShopService
{
    public function getAllProducts($perPage = 10)
    {
        return Product::with('category')->latest()->paginate($perPage);
    }

    public function getRelatedProducts(Product $product)
    {
        return Product::with('category')->where('id', '<>', $product->id)
            ->take(8)->get();
    }
}
