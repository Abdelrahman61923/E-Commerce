<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CouponRequest;
use App\Models\Coupon;
use App\Services\Dashboard\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(protected CouponService $couponService)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = $this->couponService->getAll(10);
        return view("dashboard.coupons.index", compact("coupons"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coupon = new Coupon();
        return view("dashboard.coupons.create", compact("coupon"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        $this->couponService->add($request->validated());
        return redirect()->route("admin.coupons.index")->with(
            "success","Coupon Created Successfully"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return view("dashboard.coupons.show", compact("coupon"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view("dashboard.coupons.edit", compact("coupon"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $this->couponService->update($coupon, $request->validated());
        return redirect()->route("admin.coupons.index")->with(
            "success","Coupon Updated Successfully"
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $this->couponService->delete($coupon);
        return redirect()->route("admin.coupons.index")->with(
            "success","Coupon Deleted Successfully"
        );
    }
}
