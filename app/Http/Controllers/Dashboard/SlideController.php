<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SlideRequest;
use App\Models\Slide;
use App\Services\Dashboard\SlideService;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function __construct(protected SlideService $slideService)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = $this->slideService->getAll();
        return view('dashboard.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slide = new Slide();
        return view('dashboard.slides.create', compact('slide'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SlideRequest $request)
    {
        $this->slideService->addSlide($request->validated());
        return redirect()->route('admin.slides.index')->with(
            'success', 'Slide Created Successfully'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Slide $slide)
    {
        return view('dashboard.slides.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slide $slide)
    {
        return view('dashboard.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SlideRequest $request, Slide $slide)
    {
        $this->slideService->updateSlide($slide, $request->validated());
        return redirect()->route('admin.slides.index')->with(
            'success', 'Slide Updated Successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slide $slide)
    {
        $this->slideService->delete($slide);
        return redirect()->route('admin.slides.index')->with(
            'success', 'Slide Deleted Successfully'
        );
    }
}
