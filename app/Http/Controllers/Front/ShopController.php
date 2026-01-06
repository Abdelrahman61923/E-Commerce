<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Services\Front\ShopService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function __construct(protected ShopService $shopService)
    {}

    public function index()
    {
        $products = $this->shopService->getAllProducts(9);
        return view("front.shop.index", compact("products"));
    }

    public function show(Product $product)
    {
        $product->load('category');
        $relatedproducts = $this->shopService->getRelatedProducts($product);
        return view("front.shop.product-details", compact("product", "relatedproducts"));
    }

}
