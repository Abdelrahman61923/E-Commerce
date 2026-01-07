@extends('layouts.dashboard')

@section('title', 'Show Product')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.products.index') }}">
            <div class="text-tiny">Products</div>
        </a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">Show Product</div>
    </li>
@endsection

@section('content')

    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <a class="tf-button style-1 w208" href="{{ route('admin.products.index') }}"><i class="icon-plus"></i>Back</a>
        </div>
        <div class="table-responsive">
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
                        <th colspan="2">Gallary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td class="pname">
                            <div class="image">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="image">
                            </div>
                            <div class="name">
                                <div class="body-title-2">{{ $product->name }}</div>
                                <div class="text-tiny mt-3">{{ $product->slug }}</div>
                            </div>
                        </td>
                        <td>{{ App\Helpers\Currency::format($product->price) }}</td>
                        <td>{{ App\Helpers\Currency::format($product->sale_price) }}</td>
                        <td>{{ $product->SKU }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->featured ? 'Yes' : 'No' }}</td>
                        <td>{{ $product->stock_status }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td colspan="2">
                            <div style="display: flex; gap: 6px;">
                                @foreach ($product->all_images as $img)
                                    <div class="image">
                                        <img src="{{ $img }}" alt="" class="image"
                                            style="width:50px; height:50px; object-fit:cover;">
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
        </div>
    </div>
@endsection
