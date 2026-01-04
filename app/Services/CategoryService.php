<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function getAll($perPage = 10)
    {
        return Category::with('parent')->latest()->paginate($perPage);
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
        if(isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        };
        return Category::create($data);
    }

    public function update(Category $category, array $data)
    {
        if(isset($data['image'])) {
            if($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }
        return $category->update($data);
    }

    public function delete(Category $category)
    {
        if($category->image){
            Storage::disk('public')->delete($category->image);
        }
        return $category->delete();
    }

    protected function uploadImage($imageFile)
    {
        return $imageFile->store('uploads/categories', [
            'disk' => 'public',
        ]);
    }
}
