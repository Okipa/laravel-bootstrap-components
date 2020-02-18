<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    {{ htmlAttributes($type === 'button' ? '<a' : '<button') }}{{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}{{ htmlAttributes($type === 'button' ? 'href="' . $url . '"' : 'type="' . $type . '"') }}{{ classTag('component', 'btn', $componentClasses) }}{{ htmlAttributes($label ? 'title="' . $label .'"' : null) }}{{ htmlAttributes($componentHtmlAttributes) }}>
    @if(! empty($prepend))<span class="label-prepend">{!! $prepend !!}</span>@endif
    @if($label)<span class="label">{{ $label }}</span>@endif
    @if(! empty($append))<span class="label-append">{!! $append !!}</span>@endif
    {{ htmlAttributes($type === 'button' ? '</a>' : '</button>') }}
</div>
