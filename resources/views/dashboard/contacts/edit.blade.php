@extends('layouts.dashboard')

@section('title', 'Update Status')

@section('breadcrumb')
    @parent
    <li><i class="icon-chevron-right"></i></li>
    <li>
        <div class="text-tiny">Update Status</div>
    </li>
@endsection

@section('content')

    <div class="wg-box mt-5">
        <h5>Update Message Status</h5>
        <form action="{{ route('admin.contacts.update', $contact->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3">
                    <x-form.select name="status" :options="collect(\App\Enums\ContactStatus::cases())
                        ->mapWithKeys(fn($status) => [$status->value => ucfirst($status->value)])
                        ->toArray()"
                        :selected="$contact->status->value ?? ''" />
                </div>
                <div class="col-md 3">
                    <button type="submit" class="btn btn-primary tf-button w208">Update Status</button>
                </div>
            </div>
        </form>
    </div>
@endsection
