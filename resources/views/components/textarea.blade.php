<div class="form-group">
    @if(isset($label) && $label === true)
        <label for="textarea-{{ $name }}">
            @lang('validation.attributes.' . $name)
        </label>
    @elseif(isset($label))
        <label for="textarea-{{ $name }}">
            {{ $label }}
        </label>
    @endisset
    <textarea id="textarea-{{ $name }}"
              name="{{ $name }}"
              class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}"
              placeholder="{{ isset($placeholder) ? $placeholder : __('validation.attributes.' . $name) }}"
              aria-label="{{ isset($placeholder) ? $placeholder : __('validation.attributes.' . $name) }}"
              aria-describedby="textarea-{{ $name }}"
              @if(isset($readonly) && $readonly === true)
              readonly
              @endif
              @if(isset($required) && $required === true)
              required
              @endif
              @if(isset($autofocus) && $autofocus === true)
              autofocus
        @endif>{{ old($name) ? old($name) : (isset($value) ? $value : (isset($entity->{$name}) ? $entity->{$name} : null)) }}</textarea>
    @if($errors->has($name))
        <span class="invalid-feedback d-flex">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
    @isset($legend)
        <small id="input-{{ $name }}-legend"
               class="form-text text-muted">
            {!! $legend !!}
        </small>
    @endisset
</div>
