<div{{ html_attributes($containerId ? ['id' => $containerId] : null) }}{{ html_classes('component-container', 'custom-control', 'custom-radio', $containerClasses) }}{{ html_attributes($containerHtmlAttributes) }}>
    <input id="{{ $componentId }}"{{ html_classes('component', 'custom-control-input', $componentClasses, $validationClass($errors ?? null)) }} type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"{{ html_attributes($componentHtmlAttributes, $wire) }}>
    <label class="custom-control-label" for="{{ $componentId }}">@if(! empty($prepend))<span class="label-prepend">{!! $prepend !!}</span> @endif{{ $label }}@if(! empty($append))<span class="label-append">{!! $append !!}</span> @endif</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.caption')
</div>
