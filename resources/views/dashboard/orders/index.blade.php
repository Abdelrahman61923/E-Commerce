@extends('layouts.dashboard')

@section('title', 'Orders')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">Orders</div>
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
        </div>
        <div class="wg-table table-all-user">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:70px">OrderNo</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Tax</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Order Date</th>
                            <th class="text-center">Total Items</th>
                            <th class="text-center">Delivered On</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders->count())
                            @foreach ($orders as $order)
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>
                                <td class="text-center">{{ $order->name }}</td>
                                <td class="text-center">{{ $order->phone }}</td>
                                <td class="text-center">{{ Currency::format($order->subtotal) }}</td>
                                <td class="text-center">{{ Currency::format($order->tax) }}</td>
                                <td class="text-center">{{ Currency::format($order->total) }}</td>
                                <td class="text-center">
                                    @if ($order->status == 'delivered')
                                        <span class="badge bg-success fs-5">Delivered</span>
                                    @elseif ($order->status == 'canceled')
                                        <span class="badge bg-danger fs-5">Canceled</span>
                                    @else
                                        <span class="badge bg-warning fs-5">Ordered</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $order->created_at }}</td>
                                <td class="text-center">{{ $order->order_items_count }}</td>
                                <td class="text-center">{{ $order->delivered_date }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}">
                                        <div class="list-icon-function view-icon">
                                            <div class="item eye">
                                                <i class="icon-eye"></i>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-muted text-center">No Orders defined.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="divider"></div>
            <div class="d-flex justify-content-between ">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
