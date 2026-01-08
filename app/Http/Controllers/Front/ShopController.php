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

    public function index(Request $request)
    {
        $data = $this->shopService->getProducts($request);
        return view('front.shop.index', $data);
    }

    public function show(Product $product)
    {
        $product->load('category');
        $relatedproducts = $this->shopService->getRelatedProducts($product);
        return view("front.shop.product-details", compact("product", "relatedproducts"));
    }

}
