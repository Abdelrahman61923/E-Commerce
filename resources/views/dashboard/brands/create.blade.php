@extends('layouts.dashboard')

@section('title', 'Create Brand')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.brands.index') }}"><div class="text-tiny">Brands</div></a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li><div class="text-tiny">New Brand</div></li>
@endsection

@section('content')
<div class="wg-box">
    <form class="form-new-product form-style-1" action="{{ route('admin.brands.store') }}" method="POST"
        enctype="multipart/form-data">
    @csrf
        @include('dashboard.brands._form')

    </form>
</div>
@endsection
