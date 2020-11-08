<div{{ html_attributes($containerId ? ['id' => $containerId] : null) }}{{ html_classes('component-container', $containerClasses) }}{{ html_attributes($containerHtmlAttributes) }}>
    {{ html_attributes($type === 'button' ? '<a' : '<button') }}{{ html_attributes($componentId ? ['id' => $componentId] : null) }}{{ html_attributes($type === 'button' ? 'href="' . $url . '"' : 'type="' . $type . '"') }}{{ html_classes('component', 'btn', $componentClasses) }}{{ html_attributes($label ? 'title="' . $label .'"' : null) }}{{ html_attributes($componentHtmlAttributes) }}>
    @if(! empty($prepend))<span class="label-prepend">{!! $prepend !!}</span>@endif
    @if($label)<span class="label">{{ $label }}</span>@endif
    @if(! empty($append))<span class="label-append">{!! $append !!}</span>@endif
    {{ html_attributes($type === 'button' ? '</a>' : '</button>') }}
</div>
