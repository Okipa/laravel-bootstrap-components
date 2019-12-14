<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $htmlIdentifier, $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
@if($labelPositionedAbove)
    @include('bootstrap-components::bootstrap-components.partials.label')
@endif
@if(! empty($prepend) || ! empty($append))
    <div class="input-group">
@endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <input id="{{ $componentId }}"{{ classTag('component', 'form-control', $htmlIdentifier, $componentClasses, $validationClass) }} type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"{{ htmlAttributes($placeholder ? ['placeholder' => __($placeholder)] : null, $componentHtmlAttributes) }} aria-label="{{ $label }}" aria-describedby="{{ $htmlIdentifier }}">
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
