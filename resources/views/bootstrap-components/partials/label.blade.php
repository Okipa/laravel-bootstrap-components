@if($label)
    <label{{ htmlAttributes($componentId ? ['for' => $componentId] : null) }}>@lang($label)</label>
@endif
