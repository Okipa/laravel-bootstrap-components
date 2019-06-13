<div {{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}
    {{ classTag($type . '-' . Str::slug($name) . '-container', $containerClasses) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
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
            <input id="{{ $componentId }}"
                   {{ classTag('custom-file-input', 'form-control', $type . '-' . Str::slug($name) . '-component', $componentClasses, validationStatus($name)) }}
                   type="{{ $type }}"
                   name="{{ $name }}"
                   lang="{{ app()->getLocale() }}"
                   {{ htmlAttributes($componentHtmlAttributes) }}
                   aria-label="{{ $label }}"
                   aria-describedby="file-{{ Str::slug($name) }}">
            @if(($value = old($name, $value)) || $placeholder)
                <label class="custom-file-label" for="{{ $componentId }}">@empty($value){{ $placeholder }}@else{{ $value }}@endempty</label>
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
