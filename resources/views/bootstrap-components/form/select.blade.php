<div {{ classTag($type . '-' . str_slug($name) . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    <div class="input-group">
        @include('bootstrap-components::bootstrap-components.partials.icon')
        <select id="{{ $type }}-{{ str_slug($name) }}"
                {{ classTag($type . '-' . str_slug($name) . '-component', 'custom-select', $componentClass, validationStatus($name)) }}
                name="{{ $name . ($multiple ? '[]' : '') }}"
                {{ htmlAttributes($multiple ? 'multiple' : null, $componentHtmlAttributes) }}>
            <option value="" disabled="disabled" {{ htmlAttributes(count(array_filter(array_pluck($options, 'selected'))) 
                ? null 
                : ['selected' => 'selected']) }}>{{ $placeholder }}</option>
            @foreach($options as $option)
                <option value="{{ $option[$optionValueField] }}" {{ htmlAttributes(!empty($option['selected']) && $option['selected'] === true 
                        ? ['selected' => 'selected'] 
                        : null) }}>{{ $option[$optionLabelField] }}</option>
            @endforeach
        </select>
    </div>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
