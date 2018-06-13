<div {{ classTag($type . '-' . $name . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    <select id="{{ $type }}-{{ $name }}"
            {{ classTag($type . '-' . $name . '-component', 'custom-select', $componentClass, validationStatus($name)) }}
            name="{{ $name }}"
            {{ htmlAttributes($componentHtmlAttributes) }}>
        <option value="">Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
