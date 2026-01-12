@extends('layouts.dashboard')

@section('title', 'Edit Product')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.products.index') }}"><div class="text-tiny">Products</div></a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li><div class="text-tiny">Edit Product</div></li>
@endsection

@section('content')
<div class="wg-box">
    <form class="tf-section-2 form-add-product" action="{{ route('admin.products.update', $product->slug) }}" method="POST"
        enctype="multipart/form-data">
    @csrf
    @method('put')

        @include('dashboard.products._form', [
            'button_label' => 'Update Product'
        ])
    </form>
</div>
@endsection
