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
                <h5>Ordered Details</h5>
            </div>
            <a class="tf-button style-1 w208" href="{{ route('admin.orders.index') }}">Back</a>
        </div>
        <div class="table-responsive">
            <x-alert type="success" />
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Order No</th>
                    <td>{{ $order->id }}</td>
                    <th>Mobile</th>
                    <td>{{ $order->phone }}</td>
                    <th>Zip Code</th>
                    <td>{{ $order->zip }}</td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>{{ $order->created_at }}</td>
                    <th>Delivered Date</th>
                    <td>{{ $order->delivered_date }}</td>
                    <th>Canceled Date</th>
                    <td>{{ $order->canceled_date }}</td>
                </tr>
                <tr>
                    <th>Order Status</th>
                    <td colspan="5">
                        @if ($order->status == \App\Enums\OrderStatus::DELIVERED)
                            <span class="badge bg-success fs-4">Delivered</span>
                        @elseif ($order->status == \App\Enums\OrderStatus::CANCELED)
                            <span class="badge bg-danger fs-4">Canceled</span>
                        @else
                            <span class="badge bg-warning fs-4">Ordered</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="divider"></div>
    </div>
    <div class="wg-box mt-5">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <h5>Ordered Items</h5>
            </div>
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
                                    <img src="{{ $item->product->image_url }}" alt="" class="image">
                                </div>
                                <div class="name">
                                    <a href="{{ route('shop.show', $item->product->slug) }}" target="_blank"
                                        class="body-title-2">{{ $item->product->name }}</a>
                                </div>
                            </td>
                            <td class="text-center">{{ Currency::format($item->price) }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-center">{{ $item->product->SKU }}</td>
                            <td class="text-center">{{ $item->product->category->name }}</td>
                            <td class="text-center">{{ $item->product->brand->name }}</td>
                            <td class="text-center">{{ $item->options }}</td>
                            <td class="text-center">{{ $item->rstatus ? 'Yes' : 'No' }}</td>
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
                <p>{{ $order->name }}</p>
                <p>{{ $order->address }}</p>
                <p>{{ $order->locality }}</p>
                <p>{{ $order->city }}</p>
                <p>{{ $order->landmark }}</p>
                <p>{{ $order->zip }}</p>
                <br>
                <p>Mobile : {{ $order->phone }}</p>
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
                    <td>{{ Currency::format($order->discount) }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>{{ Currency::format($order->total) }}</td>
                    <th>Payment Mode</th>
                    <td>{{ $order->transaction->mode }}</td>
                    <th>Status</th>
                    <td>
                        @if ($order->transaction->status == 'approved')
                            <span class="badge bg-success fs-4">Approved</span>
                        @elseif ($order->transaction->status == 'declinded')
                            <span class="badge bg-danger fs-4">Declinded</span>
                        @elseif ($order->transaction->status == 'refunded')
                            <span class="badge bg-secondary fs-4">Refunded</span>
                        @else
                            <span class="badge bg-warning fs-4">Pending</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="wg-box mt-5">
        <h5>Update Order Status</h5>
        <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3">
                    <x-form.select name="status" :options="\App\Enums\OrderStatus::options()" :selected="$order->status->value ?? ''" />
                </div>
                <div class="col-md 3">
                    <button type="submit" class="btn btn-primary tf-button w208">Update Status</button>
                </div>
            </div>
        </form>
    </div>
@endsection
