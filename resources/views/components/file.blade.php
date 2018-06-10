<div {{ classTag($containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @if($showLabel === true)
        <label for="file-{{ $name }}">
            {{ $label }}
        </label>
    @endif
    {{ $uploadedFile() }}
    <div class="input-group">
        @if(!empty($icon))
            <div class="input-group-prepend">
                <span class="input-group-text">
                    {!! $icon !!}
                </span>
            </div>
        @endif
        <div class="custom-file">
            <input id="file-{{ $name }}"
                   type="file"
                   name="{{ $name }}"
                   {{ classTag('custom-file-input', $componentClass) }}
                   lang="{{ app()->getLocale() }}"
                   {{ htmlAttributes($componentHtmlAttributes) }}
                   aria-label="{{ $label }}"
                   aria-describedby="file-{{ $name }}">
            <label class="custom-file-label" for="file-{{ $name }}">
                @empty($value = old($name, $value))@lang('component.label.file')@else{{ $value }}@endempty
            </label>
        </div>
    </div>
    @if ($errors->has($name))
        <span class="invalid-feedback d-flex">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
    @isset($legend)
        <small id="input-{{ $name }}-legend" class="form-text text-muted">
            {!! $legend !!}
        </small>
    @endisset()
</div>
