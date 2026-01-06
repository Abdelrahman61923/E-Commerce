<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getAll(5);
        return view("dashboard.products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $brands = $this->productService->getAllBrands();
        $categories = $this->productService->getAllCategories();
        return view("dashboard.products.create", compact('product',"brands","categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->add($request->validated());
        return redirect()->route("admin.products.index")->with(
            "success","Product Created Successfully"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category', 'brand');
        return view("dashboard.products.show", compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = $this->productService->getAllBrands();
        $categories = $this->productService->getAllCategories();
        return view("dashboard.products.edit", compact('product',"brands","categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->productService->update($product, $request->validated());
        return redirect()->route("admin.products.index")->with(
            "success","Product Updated Successfully"
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productService->delete($product);
        return redirect()->route("admin.products.index")->with(
            "success","Product Deleted Successfully"
        );
    }
}
