<div{{ html_attributes($containerId ? ['id' => $containerId] : null) }}{{ html_classes('component-container', $containerClasses) }}{{ html_attributes($containerHtmlAttributes) }}>
    @if($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endif
    @if(! empty($prepend) || ! empty($append))
        <div class="input-group">
    @endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <select id="{{ $componentId }}"{{ html_classes('component', 'custom-select', $componentClasses, $validationClass) }} name="{{ $name . ($multiple ? '[]' : '') }}"{{ html_attributes($multiple ? 'multiple' : null, $componentHtmlAttributes) }}>
            @if($placeholder)
                <option value=""{{ html_attributes(count(array_filter(Arr::pluck($options, 'selected'))) ? null : ['selected' => 'selected']) }}>{{ $placeholder }}</option>
            @endif
            @foreach($options as $option)
                <option value="{{ $option[$optionValueField] }}"{{ html_attributes(data_get($option, 'selected') ? ['selected' => 'selected'] : null, data_get($option, 'disabled') ? ['disabled'] : null) }}>{{ $option[$optionLabelField] }}</option>
            @endforeach
        </select>
        @include('bootstrap-components::bootstrap-components.partials.append')
        @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @if(! empty($prepend) || ! empty($append))
        </div>
    @endif
    @unless($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endunless
    @include('bootstrap-components::bootstrap-components.partials.caption')
</div>
