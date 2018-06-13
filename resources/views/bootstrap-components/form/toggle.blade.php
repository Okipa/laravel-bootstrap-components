<div {{ classTag($type . '-' . $name . '-container', 'switch', 'custom-control', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $type }}-{{ $name }}"
           {{ classTag($type . '-' . $name . '-component', 'custom-control-input', $componentClass, validationStatus($name)) }}
           type="checkbox"
           name="{{ $name }}"
        {{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $type }}-{{ $name }}">{{ $label }}</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
