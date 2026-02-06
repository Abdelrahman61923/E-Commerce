<?php

namespace App\Services\Dashboard;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ProductService extends AbstractService
{
    protected array $with = ['category', 'brand'];

    public function __construct(protected MediaService $mediaService)
    {
        parent::__construct();
    }

    protected function model(): Model
    {
        return new Product();
    }

    public function getAllCategories()
    {
        return Category::all();
    }
    public function getAllBrands()
    {
        return Brand::all();
    }

    public function addProduct(array $data): Product
{
    return DB::transaction(function () use ($data) {
        $product = $this->add($data);

        $this->mediaService->uploadSingle($product, $data['image'] ?? null, 'main_image');
        $this->mediaService->uploadMultiple($product, $data['images'] ?? [], 'gallery');
        return $product;
    });
}


public function updateProduct(Product $product, array $data): Product
{
    return DB::transaction(function () use ($product, $data) {
        $this->update($product, $data);

        if (!empty($data['image'])) {
            $this->mediaService->uploadSingle($product, $data['image'], 'main_image');
        }

        if (!empty($data['images'])) {
            $this->mediaService->uploadMultiple($product, $data['images'], 'gallery', true);
        }

        return $product;
    });
}

}
