<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $saleProducts = Product::whereNotNull('sale_price')->where('sale_price', '>', 0)
            ->inRandomOrder()->limit(8)->get();

        $featuredProducts = Product::where('featured', 1)->limit(8)->get();
        return view('front.home', compact('categories', 'saleProducts', 'featuredProducts'));
    }
}
