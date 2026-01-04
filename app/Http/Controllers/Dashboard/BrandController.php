<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Services\BrandService;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function __construct(protected BrandService $brandService)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->brandService->getAll(5);
        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = new Brand;
        return view('dashboard.brands.create', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $this->brandService->add($request->validated());

        return redirect()->route('admin.brands.index')->with(
            'success', 'Brand Created Successfully'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('dashboard.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $this->brandService->update($brand, $request->validated());

        return redirect()->route('admin.brands.index')->with(
            'success', 'Brand Update Successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $this->brandService->delete($brand);
        return redirect()->route('admin.brands.index')->with(
            'success', 'Brand Deleted Successfully'
        );
    }
}
