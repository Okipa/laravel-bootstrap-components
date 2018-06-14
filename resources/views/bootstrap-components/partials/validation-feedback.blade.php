@isset($errors)
    @if($errors->has($name))
        <span class="invalid-feedback">
            {{ $errors->first($name) }}
        </span>
    @else
        <span class="valid-feedback">
            {{ trans('bootstrap-components::bootstrap-components.notification.validation.success') }}
        </span>
    @endif
@endisset
