@extends('layouts.dashboard')

@section('title', 'Create Slide')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.slides.index') }}"><div class="text-tiny">Slides</div></a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li><div class="text-tiny">New Slide</div></li>
@endsection

@section('content')
<div class="wg-box">
    <form class="form-new-product form-style-1" action="{{ route('admin.slides.store') }}" method="POST"
        enctype="multipart/form-data">
    @csrf
        @include('dashboard.slides._form')

    </form>
</div>
@endsection
