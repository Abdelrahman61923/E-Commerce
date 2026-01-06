@extends('layouts.dashboard')

@section('title', 'Create Product')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.products.index') }}">
            <div class="text-tiny">Products</div>
        </a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">New Product</div>
    </li>
@endsection

@section('content')
    <form class="tf-section-2 form-add-product" action="{{ route('admin.products.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @include('dashboard.products._form')

    </form>
@endsection
