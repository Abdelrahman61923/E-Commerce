<?php

namespace App\Services\Dashboard;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandService
{
    public function getAll($perPage = 10)
    {
        return Brand::withCount('products')->latest()->paginate($perPage);
    }

    public function add(array $data)
    {
        $brand = Brand::create($data);
        if (!empty($data['image'])) {
            $brand->addMedia($data['image'])->toMediaCollection('logo');
        }
        return $brand;
    }

    public function update(Brand $brand, array $data)
    {
        $brand->update($data);
        if (!empty($data['image'])) {
            $brand->addMedia($data['image'])->toMediaCollection('logo');
        }
        return $brand;
    }

    public function delete(Brand $brand)
    {
        return $brand->delete();
    }
}
