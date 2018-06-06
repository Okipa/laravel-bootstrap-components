<div @if(!empty($containerClass))class="{{ renderHtmlClass($containerClass) }}"@endif>
    {{ toggleSwitchButton()->name($name)->checked(old($name, $checked))->icon($icon)->label($label) }}
    @if ($errors->has($name))
        <span class="invalid-feedback d-flex">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
    @isset($legend)
        <small id="input-{{ $name }}-legend"
               class="form-text text-muted">
            {!! $legend !!}
        </small>
    @endisset()
</div>
