@if(isset($errors) && $errors->isNotEmpty() && ($displaySuccess || $displayFailure))
    @if($displayFailure && $errors->has($name))
        <div class="invalid-feedback d-block">
            {!! $errors->first($name) !!}
        </div>
    @elseif($displaySuccess)
        <div class="valid-feedback d-block">
            @lang('bootstrap-components::bootstrap-components.notification.validation.success')
        </div>
    @endif
@endisset
