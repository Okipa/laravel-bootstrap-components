<div {{ classTag($id . '-container', 'switch', 'custom-control', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $id }}"
           {{ classTag($id . '-component', 'custom-control-input', $componentClass, validationStatus($name)) }}
           type="checkbox"
           name="{{ $name }}"
        {{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $id }}">{{ $label }}</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
