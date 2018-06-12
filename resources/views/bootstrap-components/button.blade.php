<div {{ classTag($type . '-container', $containerClass) }}>
    {{ htmlAttributes($containerHtmlAttributes) }}
    {{ htmlAttributes($type === 'button' ? '<a' : '<button') }} {{ htmlAttributes($type === 'button' ? 'href="' . $url . '"' : 'type="' . $type . '"') }}
        {{ classTag($type . '-component', $componentClass) }}
        {{ htmlAttributes($componentHtmlAttributes) }}
        {{ htmlAttributes($label ? 'title="' . $label .'"' : null) }}>
        @if($icon)<span class="icon">{!! $icon !!}</span>@endif
        @if($label)<span class="label">{{ $label }}</span>@endif
    {{ htmlAttributes($type === 'button' ? '</a>' : '</button>') }}
</div>
