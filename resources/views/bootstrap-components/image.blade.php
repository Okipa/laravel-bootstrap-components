<div {{ classTag($containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <a href="@isset($linkUrl){{ $linkUrl }}@endisset()"
       {{ classTag($linkClass) }}
       {{ htmlAttributes($linkHtmlAttributes) }}
       title="{{ $alt }}">
        <img width="{{ $width }}"
             height="{{ $height }}"
             {{ classTag($componentClass) }}
             {{ htmlAttributes($componentHtmlAttributes) }}
             src="{{ $src }}"
             alt="{{ $alt }}">
    </a>
</div>
