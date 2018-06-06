<div @if(!empty($containerClass))class="{{ renderHtmlClass($containerClass) }}"@endif
    {{ renderHtmlAttributes($containerHtmlAttributes) }}>
    @if($showLabel === true)
        <label for="input-{{ $name }}">
            {{ $label }}
        </label>
    @endif
    <div class="input-group">
        @if(!empty($icon))
            <div class="input-group-prepend">
                <span class="input-group-text">
                    {!! $icon !!}
                </span>
            </div>
        @endif
        <input id="input-{{ $name }}"
               class="{{ renderHtmlClass($componentClass) }} form-control{{ $errors->has($name) ? ' is-invalid' : '' }}"
               type="{{ $type }}"
               name="{{ $name }}"
               value="{{ old($name, $value) }}"
               placeholder="{{ $placeholder }}"
               {{ renderHtmlAttributes($componentHtmlAttributes) }}
               aria-label="{{ $label }}"
               aria-describedby="input-{{ $name }}">
    </div>
    @if($errors->has($name))
        <span class="invalid-feedback d-flex">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
    @empty($legend)
        <small id="input-{{ $name }}-legend" class="form-text text-muted">
            {!! $legend !!}
        </small>
    @endempty
</div>

