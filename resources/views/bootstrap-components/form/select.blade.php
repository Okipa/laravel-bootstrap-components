<div {{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}
    {{ classTag($type . '-' . str_slug($name) . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    @if(! empty($prepend) || ! empty($append))
        <div class="input-group">
    @endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <select id="{{ $componentId }}"
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
        @include('bootstrap-components::bootstrap-components.partials.append')
    @if(! empty($prepend) || ! empty($append))
        </div>
    @endif
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
