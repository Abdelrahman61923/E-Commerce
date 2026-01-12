@extends('layouts.dashboard')

@section('title', 'All Messages')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li><div class="text-tiny">All Messages</div></li>
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
        </div>
        <div class="wg-table table-all-user">
            <div class="table-responsive">

                <x-alert type="success" />

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($contacts->count())
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->comment }}</td>
                                    <td>
                                        @if ($contact->status == 'new')
                                            <span class="badge bg-warning fs-5">New</span>
                                        @elseif ($contact->status == 'read')
                                            <span class="badge bg-info fs-5">Read</span>
                                        @else
                                            <span class="badge bg-success fs-5">Replied</span>
                                        @endif
                                    </td>
                                    <td>{{ $contact->created_at }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('admin.contacts.edit', $contact->id) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="post">
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
                                <td colspan="6" class="text-muted text-center">No Contacts defined.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="divider"></div>
            <div class="d-flex justify-content-between ">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
@endsection
