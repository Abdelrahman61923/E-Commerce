@extends('layouts.dashboard')

@section('title', 'Edit Brand')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.brands.index') }}"><div class="text-tiny">Brands</div></a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li><div class="text-tiny">Edit Brand</div></li>
@endsection

@section('content')
<div class="wg-box">
    <form class="form-new-product form-style-1" action="{{ route('admin.brands.update', $brand->slug) }}" method="POST"
        enctype="multipart/form-data">
    @csrf
    @method('put')

        @include('dashboard.brands._form', [
            'button_label' => 'Update'
        ])
    </form>
</div>
@endsection
