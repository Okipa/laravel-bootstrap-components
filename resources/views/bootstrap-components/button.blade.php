<div {{ classTag($containerClass) }}>
    @if($type === 'button')
        <a href="{{ $url or url()->previous() }}"
           {{ classTag($componentClass) }}
           title="@isset($label){{ $label }}@endisset">
            @isset($icon){!! $icon !!}@endisset
            @isset($label){{ $label }}@endisset
        </a>
    @elseif($type === 'submit')
        <button type="{{ $type }}"
                {{ classTag($componentClass) }}
                title="@isset($label){{ $label }}@endisset">
            @isset($icon){!! $icon !!}@endisset
            @isset($label){{ $label }}@endisset
        </button>
    @endisset
</div>
