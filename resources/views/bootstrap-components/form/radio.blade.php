<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', 'custom-control', 'custom-radio', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $componentId }}"{{ classTag('component', 'custom-control-input', $componentClasses, $validationClass) }} type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"{{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $componentId }}">@if(! empty($prepend))<span class="label-prepend">{!! $prepend !!}</span> @endif{{ $label }}@if(! empty($append))<span class="label-append">{!! $append !!}</span> @endif</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
