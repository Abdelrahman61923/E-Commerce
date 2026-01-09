@extends('layouts.dashboard')

@section('title', 'Create Coupon')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.coupons.index') }}"><div class="text-tiny">Coupons</div></a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li><div class="text-tiny">New Coupon</div></li>
@endsection

@section('content')
<div class="wg-box">
    <form class="form-new-product form-style-1" action="{{ route('admin.coupons.store') }}" method="POST"
        enctype="multipart/form-data">
    @csrf
        @include('dashboard.coupons._form')

    </form>
</div>
@endsection
