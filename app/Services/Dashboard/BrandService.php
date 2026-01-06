<?php

namespace App\Services\Dashboard;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandService
{
    public function getAll($perPage = 10)
    {
        return Brand::latest()->paginate($perPage);
    }

    public function add(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }
        return Brand::create($data);
    }

    public function update(Brand $brand, array $data)
    {
        if (isset($data['image'])) {
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }
        return $brand->update($data);
    }

    public function delete(Brand $brand)
    {
        if ($brand->image) {
            Storage::disk('public')->delete($brand->image);
        }
        return $brand->delete();
    }

    protected function uploadImage($imageFile)
    {
        return $imageFile->store('uploads/brands', [
            'disk' => 'public',
        ]);
    }
}
