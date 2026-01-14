<?php

namespace App\Services\Dashboard;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function getAll($perPage = 10)
    {
        return Category::with('parent')->withCount('products')
            ->latest()->paginate($perPage);
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

    public function add(array $data)
    {
        $category = Category::create($data);
        if (!empty($data['image'])) {
            $category->addMedia($data['image'])->toMediaCollection('image');
        }
        return $category;
    }

    public function update(Category $category, array $data)
    {
        $category->update($data);
        if (!empty($data['image'])) {
            $category->addMedia($data['image'])->toMediaCollection('image');
        }
        return $category;
    }

    public function delete(Category $category)
    {
        return $category->delete();
    }
}
