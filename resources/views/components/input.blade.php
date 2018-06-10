<div {{ classTag('input-' . $name . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @if($showLabel === true)
        <label for="input-{{ $name }}">{{ $label }}</label>
    @endif
    <div class="input-group">
        @if(!empty($icon))
            <div class="input-group-prepend">
                <span class="icon input-group-text">{!! $icon !!}</span>
            </div>
        @endif
        <input id="input-{{ $name }}"
               {{ classTag('form-control', 'input-' . $name . '-component', $componentClass, isset($errors) && $errors->has($name) ? ' is-invalid' : null) }}
               type="{{ $type }}"
               name="{{ $name }}"
               value="{{ old($name, $value) }}"
               placeholder="{{ $placeholder }}"
               {{ htmlAttributes($componentHtmlAttributes) }}
               aria-label="{{ $label }}"
               aria-describedby="input-{{ $name }}">
    </div>
    @if(isset($errors) && $errors->has($name))
        <span class="invalid-feedback d-flex">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
    @if(!empty($legend))
        <small id="input-{{ $name }}-legend" class="form-text text-muted">{!! $legend !!}</small>
    @endif
</div>

