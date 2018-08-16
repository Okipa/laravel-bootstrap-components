<div {{ classTag($type . '-' . str_slug($name) . '-container', 'custom-control', 'custom-checkbox', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $type }}-{{ str_slug($name) }}"
           {{ classTag($type . '-' . str_slug($name) . '-component', 'custom-control-input', $componentClass, validationStatus($name)) }}
           type="{{ $type }}"
           name="{{ $name }}"
        {{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $type }}-{{ str_slug($name) }}">{{ $label }}</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
