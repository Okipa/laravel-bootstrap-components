<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $htmlIdentifier, $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    @if($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endif
    @if(! empty($prepend) || ! empty($append))
        <div class="input-group">
    @endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <select id="{{ $componentId }}"{{ classTag('component', 'custom-select', $htmlIdentifier, $componentClasses, $validationClass) }} name="{{ $name . ($multiple ? '[]' : '') }}"{{ htmlAttributes($multiple ? 'multiple' : null, $componentHtmlAttributes) }}>
            @if($placeholder)
                <option value="" disabled="disabled"{{ htmlAttributes(count(array_filter(Arr::pluck($options, 'selected'))) ? null : ['selected' => 'selected']) }}>@lang($placeholder)</option>
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
