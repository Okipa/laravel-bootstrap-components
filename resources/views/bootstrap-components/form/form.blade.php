<div{{ html_attributes($containerId ? ['id' => $containerId] : null) }}{{ html_classes('component-container', $containerClasses) }}{{ html_attributes($containerHtmlAttributes) }}>
    <form{{ html_attributes($componentId ? ['id' => $componentId] : null) }}{{ html_classes('component', 'form', $componentClasses) }}{{ html_attributes($method ? compact('method') : null) }}{{ html_attributes($action ? compact('action') : null) }}{{ html_attributes($containerHtmlAttributes) }}>
{{--        {{ $inputs }}--}}
    </form>
</div>
