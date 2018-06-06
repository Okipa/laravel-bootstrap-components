<div @if(!empty($containerClass))class="{{ renderHtmlClass($containerClass) }}"@endif
    {{ renderHtmlAttributes($containerHtmlAttributes) }}>
    <a href="@isset($linkUrl){{ $linkUrl }}@endisset()"
       @if(!empty($linkClass))class="{{ renderHtmlClass($linkClass) }}" @endif
       {{ renderHtmlAttributes($linkHtmlAttributes) }}
       title="{{ $alt }}">
        <img width="{{ $width }}"
             height="{{ $height }}"
             @if(!empty($componentClass))class="{{ renderHtmlClass($componentClass) }}" @endif
             {{ renderHtmlAttributes($componentHtmlAttributes) }}
             src="{{ $src }}"
             alt="{{ $alt }}">
    </a>
</div>
