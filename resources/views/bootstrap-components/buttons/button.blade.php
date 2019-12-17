<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    {{ htmlAttributes($type === 'button' ? '<a' : '<button') }}{{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}{{ htmlAttributes($type === 'button' ? 'href="' . $url . '"' : 'type="' . $type . '"') }}{{ classTag('component', $componentClasses) }}{{ htmlAttributes($componentHtmlAttributes) }}{{ htmlAttributes($label ? 'title="' . __($label) .'"' : null) }}>
    @if(! empty($prepend))<span class="label-prepend">{!! $prepend !!}</span>@endif
    @if($label)<span class="label">@lang($label)</span>@endif
    @if(! empty($append))<span class="label-append">{!! $append !!}</span>@endif
    {{ htmlAttributes($type === 'button' ? '</a>' : '</button>') }}
</div>
