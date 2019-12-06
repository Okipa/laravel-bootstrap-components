@if(isset($errors) && $errors->isNotEmpty() && ($displaySuccess || $displayFailure))
    @if($displayFailure && $errors->has($errorMessageBagKey))
        <div class="invalid-feedback d-block">
            {!! $errors->first($errorMessageBagKey) !!}
        </div>
    @elseif($displaySuccess)
        <div class="valid-feedback d-block">
            @lang('bootstrap-components::bootstrap-components.notification.validation.success')
        </div>
    @endif
@endisset
