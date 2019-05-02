<div {{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}
    {{ classTag($type . '-' . Str::slug($name) . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    @if($uploadedFileHtml->toHtml())
        {{ $uploadedFileHtml }}
        @if($showRemoveCheckbox){{ bsCheckbox()->name('remove_' . $name )
            ->label($removeCheckboxLabel)
            ->containerClass(['mb-1']) }}@endif
    @endif
    @if(! empty($prepend) || ! empty($append))
        <div class="input-group">
    @endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <div class="custom-file">
            <input id="{{ $componentId }}"
                   type="file"
                   name="{{ $name }}"
                   {{ classTag('custom-file-input', 'form-control', $type . '-' . Str::slug($name) . '-component', $componentClass, validationStatus($name)) }}
                   lang="{{ app()->getLocale() }}"
                   {{ htmlAttributes($componentHtmlAttributes) }}
                   aria-label="{{ $label }}"
                   aria-describedby="file-{{ Str::slug($name) }}">
            <label class="custom-file-label" for="{{ $componentId }}">@empty($value = old($name, $value)){{ $placeholder }}@else{{ $value }}@endempty</label>
        </div>
        @include('bootstrap-components::bootstrap-components.partials.append')
    @if(! empty($prepend) || ! empty($append))
        </div>
    @endif
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
