<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', 'switch', 'custom-control', $htmlIdentifier, $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $componentId }}"{{ classTag('component', 'custom-control-input', $htmlIdentifier, $componentClasses, $validationClass) }} type="checkbox" name="{{ $name }}"{{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $componentId }}">@if(! empty($prepend))<span class="label-prepend">{!! $prepend !!}</span> @endif{{ __($label) }}@if(! empty($append))<span class="label-append">{!! $append !!}</span> @endif</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
