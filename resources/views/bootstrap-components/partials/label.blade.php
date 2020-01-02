@if($label)
    <label{{ classTag($labelClasses ?? null) }}{{ htmlAttributes($componentId ? ['for' => $componentId] : null) }}>@lang($label)</label>
@endif
