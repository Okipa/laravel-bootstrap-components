@if($legend)
    <small id="{{ $type }}-{{ Str::slug($name) }}-legend" class="form-text text-muted">{!! __($legend) !!}</small>
@endif
