<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\CategoryService;
use App\Http\Requests\Dashboard\CategoryRequest;

class CategoriesController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getAll(5);
        return view("dashboard.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        $parents = $this->categoryService->getAllParent();
        return view("dashboard.categories.create", compact("category", "parents"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryService->addCategory($request->validated());
        return redirect()->route("admin.categories.index")->with(
            "success","Category Created Successfully"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('parent');
        return view("dashboard.categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parents = $this->categoryService->getAvailableParents($category);

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($category,$request->validated());
        return redirect()->route("admin.categories.index")->with(
            "success","Category Updated Successfully"
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);
        return redirect()->route("admin.categories.index")->with(
            "success","Category deleted Successfully"
        );
    }
}
