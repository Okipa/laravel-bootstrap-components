<div {{ classTag($type . '-' . str_slug($name) . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    @if($uploadedFileHtml->toHtml())
        {{ $uploadedFileHtml }}
        @if($showRemoveCheckbox){{ bsCheckbox()->name('remove_' . $name )->containerClass(['mb-1']) }}@endif
    @endif
    <div class="input-group">
        @include('bootstrap-components::bootstrap-components.partials.icon')
        <div class="custom-file">
            <input id="file-{{ str_slug($name) }}"
                   type="file"
                   name="{{ $name }}"
                   {{ classTag('custom-file-input', 'form-control', $type . '-' . str_slug($name) . '-component', $componentClass, validationStatus($name)) }}
                   lang="{{ app()->getLocale() }}"
                   {{ htmlAttributes($componentHtmlAttributes) }}
                   aria-label="{{ $label }}"
                   aria-describedby="file-{{ str_slug($name) }}">
            <label class="custom-file-label" for="file-{{ str_slug($name) }}">@empty($value = old($name, $value)){{ $placeholder }}@else{{ $value }}@endempty</label>
        </div>
    </div>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
