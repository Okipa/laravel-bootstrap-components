@if($label)
    <label for="{{ $type }}-{{ str_slug($name) }}">{{ $label }}</label>
@endif
