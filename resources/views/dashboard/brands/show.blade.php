@extends('layouts.dashboard')

@section('title', 'Show Brand')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><a href="{{ route('admin.brands.index') }}">
            <div class="text-tiny">Brands</div>
        </a></li>
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">Show Brand</div>
    </li>
@endsection

@section('content')

    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <a class="tf-button style-1 w208" href="{{ route('admin.brands.index') }}">Back</a>
        </div>
        <div class="wg-table table-all-user">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Products</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}"
                                        class="image">
                                </div>
                                <div class="name">
                                    {{ $brand->name }}
                                </div>
                            </td>
                            <td>{{ $brand->slug }}</td>
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
