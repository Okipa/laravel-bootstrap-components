<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag($type . '-' . Str::slug($name) . '-container', 'switch', 'custom-control', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $componentId }}" {{ classTag($type . '-' . Str::slug($name) . '-component', 'custom-control-input', $componentClasses, validationStatus($name)) }}type="checkbox" name="{{ $name }}" {{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $componentId }}">@if(! empty($prepend))<span class="label-prepend">{!! $prepend !!}</span> @endif{{ __($label) }}@if(! empty($append))<span class="label-append">{!! $append !!}</span> @endif</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
