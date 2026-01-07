@extends('layouts.dashboard')

@section('title', 'Show Category')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.categories.index') }}">
            <div class="text-tiny">Categories</div>
        </a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">Show Category</div>
    </li>
@endsection

@section('content')

    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <a class="tf-button style-1 w208" href="{{ route('admin.categories.index') }}">Back</a>
        </div>
        <div class="wg-table table-all-user">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Category Parent</th>
                            <th>Products</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                                        class="image">
                                </div>
                                <div class="name">
                                    {{ $category->name }}
                                </div>
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->parent->name ?? '-' }}</td>
                            <td><a href="#">0</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="divider"></div>
            <div class="d-flex justify-content-between ">
            </div>
        </div>
    </div>
@endsection
