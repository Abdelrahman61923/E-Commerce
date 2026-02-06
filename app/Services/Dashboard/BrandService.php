<?php

namespace App\Services\Dashboard;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Services\Dashboard\MediaService;

class BrandService extends AbstractService
{
    protected array $withCount = ['products'];

    public function __construct(protected MediaService $mediaService)
    {
        parent::__construct();
    }

    protected function model(): Model
    {
        return new Brand();
    }

    public function addBrand(array $data): Brand
    {
        return DB::transaction(function () use ($data) {
            $brand = $this->add($data);

            $this->mediaService->uploadSingle($brand, $data['image'] ?? null, 'logo');
            return $brand;
        });
    }

    public function updateBrand(Brand $brand, array $data): Brand
    {
        return DB::transaction(function () use ($brand, $data) {
            $this->update($brand, $data);

            $this->mediaService->uploadSingle($brand, $data['image'] ?? null, 'logo');
            return $brand;
        });
    }
}
