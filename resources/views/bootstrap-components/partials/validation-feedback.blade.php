@if(isset($errors) && $errors instanceof \Illuminate\Support\MessageBag)
    @if($errorMessage && $displayFailure)
        <div class="invalid-feedback d-block">
            {!! $errorMessage !!}
        </div>
    @elseif($displaySuccess)
        <div class="valid-feedback d-block">
            @lang('bootstrap-components::bootstrap-components.notification.validation.success')
        </div>
    @endif
@endif
