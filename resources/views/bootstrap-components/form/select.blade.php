<div {{ classTag($type . '-' . $name . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    <select id="{{ $type }}-{{ $name }}"
            {{ classTag($type . '-' . $name . '-component', 'custom-select', $componentClass, validationStatus($name)) }}
            name="{{ $name }}"
            {{ htmlAttributes($componentHtmlAttributes) }}>
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $option)
            <option value="{{ $option[$optionValueField] }}">{{ $option[$optionLabelField] }}</option>
        @endforeach
    </select>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
