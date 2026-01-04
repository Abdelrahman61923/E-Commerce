@props([
    'type' => 'text', 'name', 'value' => '', 'label' => false
])
@if ($label)
    <div class="body-title">{{ $label }}<span class="tf-color-1">*</span></div>
@endif

<input type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->class([
            'flex-grow',
            'is-invalid' => $errors->has($name),
        ]) }}
        >


