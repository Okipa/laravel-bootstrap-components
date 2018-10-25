<div {{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}
    {{ classTag($type . '-' . str_slug($name) . '-container', 'custom-control', 'custom-checkbox', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $componentId }}"
           {{ classTag($type . '-' . str_slug($name) . '-component', 'custom-control-input', $componentClass, validationStatus($name)) }}
           type="{{ $type }}"
           name="{{ $name }}"
        {{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $componentId }}">@if($icon)<span class="{{ $componentId }}-icon">{!! $icon !!}</span> @endif{{ $label }}</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
