@php
    $locale = ! isset($locale) ? null : $locale;
    $name = $name . ($locale ? '_' . $locale : '');
    $containerId = $containerId
    ? $containerId . ($locale ? '-' . $locale : '')
    : ($locale ? $type . '-' . Str::slug($name) . '-container' : null);
    $componentId = $componentId . ($locale ? '-' . $locale : '');
    $label = $label ? __($label) . ($locale ? ' (' . strtoupper($locale) . ')' : '' ) : null;
    $placeholder = $placeholder ? ['placeholder' => __($placeholder) . ($locale ? ' (' . strtoupper($locale) . ')' : '' )] : null;
@endphp
<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag($type . '-' . Str::slug($name) . '-container', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
@if($labelPositionedAbove)
    @include('bootstrap-components::bootstrap-components.partials.label')
@endif
@if(! empty($prepend) || ! empty($append))
    <div class="input-group">
@endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <input id="{{ $componentId }}"{{ classTag('form-control', $type . '-' . Str::slug($name) . '-component', $componentClasses, $validationClass) }} type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"{{ htmlAttributes($placeholder, $componentHtmlAttributes) }} aria-label="{{ $label }}" aria-describedby="{{ $type }}-{{ Str::slug($name) }}">
        @include('bootstrap-components::bootstrap-components.partials.append')
@if(! empty($prepend) || ! empty($append))
    </div>
@endif
@unless($labelPositionedAbove)
    @include('bootstrap-components::bootstrap-components.partials.label')
@endunless
@include('bootstrap-components::bootstrap-components.partials.validation-feedback')
@include('bootstrap-components::bootstrap-components.partials.legend')
</div>
