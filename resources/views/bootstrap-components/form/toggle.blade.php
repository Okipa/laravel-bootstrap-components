<div {{ classTag($type . '-' . str_slug($name) . '-container', 'switch', 'custom-control', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $type }}-{{ str_slug($name) }}"
           {{ classTag($type . '-' . str_slug($name) . '-component', 'custom-control-input', $componentClass, validationStatus($name)) }}
           type="checkbox"
           name="{{ $name }}"
        {{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $type }}-{{ str_slug($name) }}">{{ $label }}</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
