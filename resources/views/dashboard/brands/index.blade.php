@extends('layouts.dashboard')

@section('title', 'Brands')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">Brands</div>
    </li>
@endsection

@section('content')

    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search">
                    <fieldset class="name">
                        <input type="text" placeholder="Search here..." class="" name="name" tabindex="2"
                            value="" aria-required="true" required="">
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <a class="tf-button style-1 w208" href="{{ route('admin.brands.create') }}"><i class="icon-plus"></i>Add new</a>
        </div>
        <div class="wg-table table-all-user">
            <div class="table-responsive">

                <x-alert type="success" />

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Products</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($brands->count())
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{ $brand->image_url }}" alt="{{ $brand->name }}" class="image">
                                        </div>
                                        <div class="name">
                                            <a href="{{ route('admin.brands.show', $brand->slug) }}"
                                                class="body-title-2">{{ $brand->name }}</a>
                                        </div>
                                    </td>
                                    <td>{{ $brand->slug }}</td>
                                    <td><a href="#">{{ $brand->products_count }}</a></td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('admin.brands.edit', $brand->slug) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <form action="{{ route('admin.brands.destroy', $brand->slug) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-muted text-center">No Brands defined.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="divider"></div>
            <div class="d-flex justify-content-between ">
                {{ $brands->links() }}
            </div>
        </div>
    </div>
@endsection
