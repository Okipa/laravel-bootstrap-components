<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag($type . '-' . Str::slug($name) . '-container', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    @if($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endif
    @if(! empty($prepend) || ! empty($append))
        <div class="input-group">
    @endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <select id="{{ $componentId }}" {{ classTag($type . '-' . Str::slug($name) . '-component', 'custom-select', $componentClasses, validationStatus($name)) }}name="{{ $name . ($multiple ? '[]' : '') }}" {{ htmlAttributes($multiple ? 'multiple' : null, $componentHtmlAttributes) }}>
            @if(! empty($placeholder))
                <option value="" disabled="disabled"{{ htmlAttributes(count(array_filter(Arr::pluck($options, 'selected'))) ? null : ['selected' => 'selected']) }}>{{ $placeholder }}</option>
            @endif
            @foreach($options as $option)
                <option value="{{ $option[$optionValueField] }}"{{ htmlAttributes(!empty($option['selected']) && $option['selected'] === true ? ['selected' => 'selected'] : null) }}>{{ $option[$optionLabelField] }}</option>
            @endforeach
        </select>
        @include('bootstrap-components::bootstrap-components.partials.append')
    @if(! empty($prepend) || ! empty($append))
        </div>
    @endif
    @unless($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endunless
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
