<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    @if($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endif
    @if($uploadedFileHtml->toHtml())
        {{ $uploadedFileHtml }}
        @if($showRemoveCheckbox){{ bsCheckbox()->name('remove_' . $name )
            ->label($removeCheckboxLabel)
            ->containerClasses(['mb-1']) }}@endif
    @endif
    @if(! empty($prepend) || ! empty($append))
        <div class="input-group">
    @endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <div class="custom-file">
            <input id="{{ $componentId }}"{{ classTag('component', 'custom-file-input', 'form-control', $componentClasses, $validationClass) }} type="{{ $type }}" name="{{ $name }}" lang="{{ app()->getLocale() }}"{{ htmlAttributes($componentHtmlAttributes) }} aria-labelledby="{{ $label }}">
            @if(($value = old($name, $value)) || $placeholder)
                <label class="custom-file-label" for="{{ $componentId }}">@empty($value){{ __($placeholder) }}@else{{ $value }}@endempty</label>
            @endif
        </div>
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
