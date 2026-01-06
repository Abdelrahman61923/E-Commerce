<?php

namespace App\Services\Dashboard;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        if (!empty($data['images']) && is_array($data['images'])) {
            $data['images'] = $this->uploadGalleryImages($data['images']);
        }

        return Product::create($data);
    }

    public function update(Product $product, array $data)
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }

        if (!empty($data['images']) && is_array($data['images'])) {
            if ($product->images) {
                foreach ($product->images as $img) {
                    if (Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }
            $data['images'] = $this->uploadGalleryImages($data['images']);
        }
        $product->update($data);
        return $product;
    }
    public function delete(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        if ($product->images && is_array($product->images)) {
            foreach ($product->images as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }
        return $product->delete();
    }

    protected function uploadImage(UploadedFile $imageFile): string
    {
        $mainPath = $imageFile->store('uploads/products', 'public');
        // $imageFile->store('uploads/products/gallery', 'public');
        return $mainPath;
    }

    protected function uploadGalleryImages(array $images): array
    {
        return collect($images)
            ->map(function ($image) {
                return $image->store('uploads/products/gallery', 'public');
            })
            ->toArray();
    }
}
