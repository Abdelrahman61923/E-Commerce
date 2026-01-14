<?php

namespace App\Services\Dashboard;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductService
{
    public function getAll($perPage = 10)
    {
        return Product::with('category', 'brand')->latest()->paginate($perPage);
    }

    public function getAllCategories()
    {
        return Category::all();
    }
    public function getAllBrands()
    {
        return Brand::all();
    }

    public function add(array $data)
    {
        $product = Product::create($data);

        if (!empty($data['image'])) {
            $product->addMedia($data['image'])->toMediaCollection('main_image');
        }

        if (!empty($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $image) {
                $product->addMedia($image)->toMediaCollection('gallery');
            }
        }

        return $product;
    }

    public function update(Product $product, array $data)
    {
        $product->update($data);

        if (!empty($data['image'])) {
            $product->addMedia($data['image'])->toMediaCollection('main_image');
        }

        if (!empty($data['images']) && is_array($data['images'])) {
            $product->clearMediaCollection('gallery');
            foreach ($data['images'] as $image) {
                $product->addMedia($image)->toMediaCollection('gallery');
            }
        }
        return $product;
    }

    public function delete(Product $product)
    {
        return $product->delete();
    }
}
