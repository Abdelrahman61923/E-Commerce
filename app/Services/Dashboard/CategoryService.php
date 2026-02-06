<?php

namespace App\Services\Dashboard;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CategoryService extends AbstractService
{
    protected array $withCount = ['products'];
    protected array $with = ['parent'];

    public function __construct(protected MediaService $mediaService)
    {
        parent::__construct();
    }

    protected function model(): Model
    {
        return new Category();
    }

    public function getAllParent()
    {
        return Category::all();
    }

    public function getAvailableParents(Category $category)
    {
        return Category::where('id', '!=', $category->id)
            ->where(function ($query) use ($category) {
                $query->whereNull('parent_id')
                      ->orWhere('parent_id', '!=', $category->id);
            })
            ->get();
    }

    public function addCategory(array $data): Category
    {
        return DB::transaction(function () use ($data) {
            $category = $this->add($data);

            $this->mediaService->uploadSingle($category, $data['image'] ?? null, 'image');
            return $category;
        });
    }

    public function updateCategory(Category $category, array $data): Category
    {
        return DB::transaction(function () use ($category, $data) {
            $this->update($category, $data);

            $this->mediaService->uploadSingle($category, $data['image'] ?? null, 'image');
            return $category;
        });
    }
}
