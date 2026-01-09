@extends('layouts.dashboard')

@section('title', 'Edit Coupon')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.coupons.index') }}"><div class="text-tiny">Coupons</div></a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li><div class="text-tiny">Edit Coupon</div></li>
@endsection

@section('content')
<div class="wg-box">
    <form class="form-new-product form-style-1" action="{{ route('admin.coupons.update', $coupon->code) }}" method="POST"
        enctype="multipart/form-data">
    @csrf
    @method('put')

        @include('dashboard.coupons._form', [
            'button_label' => 'Update'
        ])
    </form>
</div>
@endsection
