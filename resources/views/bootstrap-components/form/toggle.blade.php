<div {{ classTag($type . '-' . $name . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <span class="switch custom-control">
        <input id="{{ $type }}-{{ $name }}"
               {{ classTag($type . '-' . $name . '-component', 'switch', 'custom-control-input', $componentClass, validationStatus($name)) }}
               type="checkbox"
               name="{{ $name }}"
               {{ htmlAttributes($componentHtmlAttributes) }}>
        <label class="custom-control-label m-0"
               for="{{ $type }}-{{ $name }}">{{ $label }}</label>
    </span>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
