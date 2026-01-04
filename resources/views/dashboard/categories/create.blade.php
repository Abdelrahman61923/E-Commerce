@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.categories.index') }}"><div class="text-tiny">Categories</div></a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li><div class="text-tiny">New Category</div></li>
@endsection

@section('content')
<div class="wg-box">
    <form class="form-new-product form-style-1" action="{{ route('admin.categories.store') }}" method="POST"
        enctype="multipart/form-data">
    @csrf
        @include('dashboard.categories._form')

    </form>
</div>
@endsection
