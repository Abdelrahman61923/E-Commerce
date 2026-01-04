@if (session()->has($type))
    <div class="alert fs-5 alert-{{ $type }}">
        {{ session($type) }}
    </div>
@endif
