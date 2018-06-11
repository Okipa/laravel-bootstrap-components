@if(isset($errors) && $errors->has($name))
    <span class="invalid-feedback d-flex">
        <strong>{{ $errors->first($name) }}</strong>
    </span>
@endif
