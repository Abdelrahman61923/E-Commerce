@extends('layouts.dashboard')

@section('title', 'Show Coupon')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.coupons.index') }}">
            <div class="text-tiny">Coupons</div>
        </a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">Show Coupon</div>
    </li>
@endsection

@section('content')

    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <a class="tf-button style-1 w208" href="{{ route('admin.coupons.index') }}">Back</a>
        </div>
        <div class="wg-table table-all-user">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Value</th>
                            <th>Cart Value</th>
                            <th>Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $coupon->id }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->type }}</td>
                            @if ($coupon->type == \App\Enums\CouponType::PERCENT)
                                <td>%{{ $coupon->value }}</td>
                            @else
                                <td>{{ $coupon->value }}</td>
                            @endif
                            <td>{{ $coupon->cart_value }}</td>
                            <td>{{ $coupon->expiry_date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="divider"></div>
            <div class="d-flex justify-content-between ">
            </div>
        </div>
    </div>
@endsection
