<div @if(!empty($containerClass))class="{{ renderHtmlClass($containerClass) }}"@endif>
    @if($type === 'button')
        <a href="{{ $url or url()->previous() }}"
           @if(!empty($componentClass))class="{{ renderHtmlClass($componentClass) }}"@endif
           title="@isset($label){{ $label }}@endisset">
            @isset($icon){!! $icon !!}@endisset
            @isset($label){{ $label }}@endisset
        </a>
    @elseif($type === 'submit')
        <button type="{{ $type }}"
                @if(!empty($componentClass))class="{{ renderHtmlClass($componentClass) }}"@endif
                title="@isset($label){{ $label }}@endisset">
            @isset($icon){!! $icon !!}@endisset
            @isset($label){{ $label }}@endisset
        </button>
    @endisset
</div>
