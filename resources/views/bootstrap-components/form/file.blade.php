<div{{ html_attributes($containerId ? ['id' => $containerId] : null) }}{{ html_classes('component-container', $containerClasses) }}{{ html_attributes($containerHtmlAttributes) }}>
    @if($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endif
    @if(trim($uploadedFileHtml->toHtml()))
        <div class="mb-2">
            <div id="uploaded-{{ $componentId }}">{{ $uploadedFileHtml }}</div>
            @if($showRemoveCheckbox){{ inputCheckbox()->name($removeCheckboxName)->label($removeCheckboxLabel)->containerClasses(['mt-1']) }}@endif
        </div>
    @endif
    @if(! empty($prepend) || ! empty($append))
        <div class="input-group">
    @endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <div class="custom-file">
            <input id="{{ $componentId }}"{{ html_classes('component', 'form-control', 'custom-file-input', $componentClasses, $validationClass($errors ?? null)) }} type="{{ $type }}" name="{{ $name }}"{{ html_attributes($componentHtmlAttributes, $wire) }}>
            @if($placeholder || ($value = old($name, $value)))
                <label class="custom-file-label" for="{{ $componentId }}">@if(isset($value) && $value !== ''){{ $value }}@else{{ $placeholder }}@endempty</label>
            @endif
        </div>
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
