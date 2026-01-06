@props(['label' => '', 'name', 'option1' => '', 'options' => [], 'selected' => false,
])

<div class="body-title mb-10">{{ $label }}<span class="tf-color-1">*</span></div>

<select name="{{ $name }}" id="{{ $name }}"
    {{ $attributes->class([
        'flex-grow',
        'is-invalid' => $errors->has($name),
    ]) }}>

    @if ($option1)
        <option value="">{{ $option1 }}</option>
    @endif

    @foreach ($options as $value => $text)
        <option value="{{ $value }}" @selected(old($name, $selected) == $value)>
            {{ $text }}
        </option>
    @endforeach
</select>
