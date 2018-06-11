<div {{ classTag('file-' . $name . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::components.partials.label')
    @if($uploadedFile){{ $uploadedFile() }}@endif
    <div class="input-group">
        @include('bootstrap-components::components.partials.icon')
        <div class="custom-file">
            <input id="file-{{ $name }}"
                   type="file"
                   name="{{ $name }}"
                   {{ classTag('custom-file-input', 'form-control', 'file-' . $name . '-component', $componentClass, isset($errors) && $errors->has($name) ? ' is-invalid' : null) }}
                   lang="{{ app()->getLocale() }}"
                   {{ htmlAttributes($componentHtmlAttributes) }}
                   aria-label="{{ $label }}"
                   aria-describedby="file-{{ $name }}">
            <label class="custom-file-label" for="file-{{ $name }}">@empty($value = old($name, $value)){{ $placeholder }}@else{{ $value }}@endempty</label>
        </div>
    </div>
    @include('bootstrap-components::components.partials.error')
    @include('bootstrap-components::components.partials.legend')
</div>
