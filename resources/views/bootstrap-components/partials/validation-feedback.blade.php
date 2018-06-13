@isset($errors)
    @if($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @else
        <div class="valid-feedback">
            {{ trans('bootstrap-components::bootstrap-components.notification.validation.success') }}
        </div>
    @endif
@endisset
