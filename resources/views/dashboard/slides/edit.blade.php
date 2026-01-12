@extends('layouts.dashboard')

@section('title', 'Edit Slide')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.slides.index') }}"><div class="text-tiny">Slides</div></a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li><div class="text-tiny">Edit Slide</div></li>
@endsection

@section('content')
<div class="wg-box">
    <form class="form-new-product form-style-1" action="{{ route('admin.slides.update', $slide->id) }}" method="POST"
        enctype="multipart/form-data">
    @csrf
    @method('put')

        @include('dashboard.slides._form', [
            'button_label' => 'Update'
        ])
    </form>
</div>
@endsection
