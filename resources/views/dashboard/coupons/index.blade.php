@extends('layouts.dashboard')

@section('title', 'Coupons')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">Coupons</div>
    </li>
@endsection

@section('content')

    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search">
                    <fieldset class="name">
                        <input type="text" placeholder="Search here..." class="" name="name" tabindex="2"
                            value="" aria-required="true" required="">
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <a class="tf-button style-1 w208" href="{{ route('admin.coupons.create') }}"><i class="icon-plus"></i>Add
                new</a>
        </div>
        <div class="wg-table table-all-user">
            <div class="table-responsive">

                <x-alert type="success" />

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Value</th>
                            <th>Cart Value</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($coupons->count())
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>
                                        <div class="name">
                                            <a href="{{ route('admin.coupons.show', $coupon->code) }}"
                                                class="body-title-2">{{ $coupon->code }}</a>
                                        </div>
                                    </td>
                                    <td>{{ $coupon->type }}</td>
                                    @if ($coupon->type == 'percent')
                                        <td>%{{ $coupon->value }}</td>
                                    @else
                                        <td>{{ $coupon->value }}</td>
                                    @endif
                                    <td>{{ $coupon->cart_value }}</td>
                                    <td>{{ $coupon->expiry_date }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('admin.coupons.edit', $coupon->code) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <form action="{{ route('admin.coupons.destroy', $coupon->code) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-muted text-center">No Coupons defined.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="divider"></div>
            <div class="d-flex justify-content-between ">
                {{ $coupons->links() }}
            </div>
        </div>
    </div>
@endsection
