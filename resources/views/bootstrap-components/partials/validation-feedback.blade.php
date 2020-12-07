@if($errorMessage = $errorMessage($errors ?? null, $locale ?? null))
    <div class="invalid-feedback d-block">
        {!! $errorMessage !!}
    </div>
@elseif($successMessage = $successMessage())
    <div class="valid-feedback d-block">
        {!! $successMessage !!}
    </div>
@endif
