<div {{ classTag($id . '-container', 'custom-control', 'custom-checkbox', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $id }}"
           {{ classTag($id . '-component', 'custom-control-input', $componentClass, validationStatus($name)) }}
           type="{{ $type }}"
           name="{{ $name }}"
        {{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $id }}">{{ $label }}</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
