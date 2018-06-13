<div {{ classTag($type . '-' . $name . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <div class="custom-control custom-checkbox">
        <input id="{{ $type }}-{{ $name }}"
               {{ classTag($type . '-' . $name . '-component', 'custom-control-input', $componentClass, validationStatus($name)) }}
               type="checkbox"
               {{ htmlAttributes($componentHtmlAttributes) }}>
        <label class="custom-control-label"
               for="{{ $type }}-{{ $name }}">{{ $label }}</label>
    </div>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
