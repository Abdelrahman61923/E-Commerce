@extends('layouts.dashboard')

@section('title', 'Order Details')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.orders.index') }}">
            <div class="text-tiny">Orders</div>
        </a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">Order Details</div>
    </li>
@endsection

@section('content')

    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <h5>Ordered Items</h5>
            </div>
            <a class="tf-button style-1 w208" href="{{ route('admin.orders.index') }}">Back</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">SKU</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Brand</th>
                        <th class="text-center">Options</th>
                        <th class="text-center">Return Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="" class="image">
                                </div>
                                <div class="name">
                                    <a href="#" target="_blank" class="body-title-2">{{ $item->product->name }}</a>
                                </div>
                            </td>
                            <td class="text-center">{{ Currency::format($item->price) }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-center">{{ $item->product->SKU }}</td>
                            <td class="text-center">{{ $item->product->category->name }}</td>
                            <td class="text-center">{{ $item->product->brand->name }}</td>
                            <td class="text-center"></td>
                            <td class="text-center">No</td>
                            <td class="text-center">
                                <div class="list-icon-function view-icon">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

        </div>
    </div>

    <div class="wg-box mt-5">
        <h5>Shipping Address</h5>
        <div class="my-account__address-item col-md-6">
            <div class="my-account__address-item__detail">
                <p>{{ $order->user->defaultAddress->name }}</p>
                <p>Flat No - 13, R. K. Wing - B</p>
                <p>ABC, DEF</p>
                <p>GHT, </p>
                <p>AAA</p>
                <p>000000</p>
                <br>
                <p>Mobile : {{ $order->user->defaultAddress->phone }}</p>
            </div>
        </div>
    </div>

    <div class="wg-box mt-5">
        <h5>Transactions</h5>
        <table class="table table-striped table-bordered table-transaction">
            <tbody>
                <tr>
                    <th>Subtotal</th>
                    <td>{{ Currency::format($order->subtotal) }}</td>
                    <th>Tax</th>
                    <td>{{ Currency::format($order->tax) }}</td>
                    <th>Discount</th>
                    <td>{{ Currency::format($order->dicount) }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>{{ Currency::format($order->total) }}</td>
                    <th>Payment Mode</th>
                    <td>{{ $order->transaction->mode }}</td>
                    <th>Status</th>
                    <td>{{ $order->transaction->status }}</td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>{{ $order->created_at }}</td>
                    <th>Delivered Date</th>
                    <td></td>
                    <th>Canceled Date</th>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
