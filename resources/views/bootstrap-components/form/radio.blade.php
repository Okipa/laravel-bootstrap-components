<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('container', $htmlIdentifier, 'custom-control', 'custom-radio', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $componentId }}"{{ classTag('component', $htmlIdentifier, 'custom-control-input', $componentClasses, $validationClass) }} type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"{{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $componentId }}">@if(! empty($prepend))<span class="label-prepend">{!! $prepend !!}</span> @endif{{ __($label) }}@if(! empty($append))<span class="label-append">{!! $append !!}</span> @endif</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
