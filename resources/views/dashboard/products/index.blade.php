@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">Products</div>
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
            <a class="tf-button style-1 w208" href="{{ route('admin.products.create') }}"><i class="icon-plus"></i>Add
                new</a>
        </div>
        <div class="table-responsive">

            <x-alert type="success" />

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>SalePrice</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Featured</th>
                        <th>Stock</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($products->count())
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td class="pname">
                                    <div class="image">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="image">
                                    </div>
                                    <div class="name">
                                        <a href="{{ route('admin.products.show', $product->slug) }}" class="body-title-2">{{ $product->name }}</a>
                                        <div class="text-tiny mt-3">{{ $product->slug }}</div>
                                    </div>
                                </td>
                                <td>${{ $product->price }}</td>
                                <td>${{ $product->sale_price }}</td>
                                <td>{{ $product->SKU }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>{{ $product->featured? 'Yes' : 'No' }}</td>
                                <td>{{ $product->stock_status }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <div class="list-icon-function">
                                        <a href="{{ route('admin.products.edit', $product->slug) }}">
                                            <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->slug) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="item text-danger delete">
                                                <i class="icon-trash-2"></i>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="text-muted text-center">No Products defined.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="divider"></div>
        <div class="d-flex justify-content-between ">
            {{ $products->links() }}
        </div>
    </div>
@endsection
