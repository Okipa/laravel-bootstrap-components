@if($label)
    <label for="{{ $componentId }}">@lang($label) ({{ $locale ? strtoupper($locale) : '' }})</label>
@endif
