<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag($type . '-' . Str::slug($name) . '-container', 'custom-control', 'custom-checkbox', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $componentId }}" {{ classTag($type . '-' . Str::slug($name) . '-component', 'custom-control-input', $componentClasses, validationStatus($name)) }}type="{{ $type }}" name="{{ $name }}" {{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $componentId }}">@if(! empty($prepend))<span class="label-prepend">{!! $prepend !!}</span> @endif{{ $label }}@if(! empty($append))<span class="label-append">{!! $append !!}</span> @endif</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
