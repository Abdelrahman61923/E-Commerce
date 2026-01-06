@props([
    'name', 'value' => '', 'label' => false
])
@if ($label)
    <div class="body-title mb-10">{{ $label }}<span class="tf-color-1">*</span></div>
@endif

<textarea
        name="{{ $name }}"
        {{ $attributes->class([
            'is-invalid' => $errors->has($name),
        ]) }}
        >{{ old($name, $value) }}</textarea>
@error($name)
    <div class="invalid-feedback fs-5">
        {{ $message }}
    </div>
@enderror
