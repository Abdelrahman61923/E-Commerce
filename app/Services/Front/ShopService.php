<?php

namespace App\Services\Front;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopService
{
    public function getProducts(Request $request)
    {
        $size = $request->query('size', 12);

        $order = $request->query('order', -1);
        $sorts = [
            1 => ['created_at', 'DESC'],
            2 => ['created_at', 'ASC'],
            3 => ['price', 'ASC'],
            4 => ['price', 'DESC'],
        ];
        [$o_column, $o_order] = $sorts[$order] ?? ['id', 'DESC'];

        $f_brands = $request->query('brands');
        $brands = Brand::with('products')->get();

        $f_categories = $request->query('categories');
        $categories = Category::with('products')->orderBy('name', 'ASC')->get();

        $min = Product::selectRaw('MIN(COALESCE(sale_price, price)) as min_price')->value('min_price');
        $max = Product::selectRaw('MAX(COALESCE(sale_price, price)) as max_price')->value('max_price');
        $min_price = $request->query('min', $min);
        $max_price = $request->query('max',$max);

        $products = Product::with('category')
            ->where(function($query) use ($f_brands) {
                $query->whereIn('brand_id', explode(',', $f_brands))
                    ->orWhereRaw("'". $f_brands ."'=''");
            })
            ->where(function($query) use ($f_categories) {
                $query->whereIn('category_id', explode(',', $f_categories))
                    ->orWhereRaw("'". $f_categories ."'=''");
            })
            ->where(function($query) use ($min_price, $max_price) {
                $query->whereBetween('price', [$min_price, $max_price])
                ->orWhereBetween('sale_price', [$min_price, $max_price]);
            })
            ->orderBy($o_column, $o_order)
            ->paginate($size);

        return [
            'order' => $order,
            'size' => $size,
            'brands'=> $brands,
            'f_brands' => $f_brands,
            'categories'=> $categories,
            'f_categories' => $f_categories,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'min' => $min,
            'max' => $max,
            'products' => $products,
        ];
    }

    public function getRelatedProducts(Product $product)
    {
        return Product::with('category')->where('id', '<>', $product->id)
            ->take(8)->get();
    }
}
