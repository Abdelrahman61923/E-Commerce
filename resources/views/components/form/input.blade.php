@props([
    'type' => 'text',
    'name',
    'value' => '',
    'label' => false,
])
@if ($label)
    <div class="body-title mb-10">{{ $label }}<span class="tf-color-1">*</span></div>
@endif

<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
    {{ $attributes->class(['flex-grow', 'is-invalid' => $errors->has($name)]) }}>


@error($name)
    <div class="invalid-feedback fs-5">
        {{ $message }}
    </div>
@enderror
