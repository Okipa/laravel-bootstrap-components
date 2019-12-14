<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $htmlIdentifier, $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    <audio{{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}{{ classTag('component', $htmlIdentifier, $componentClasses) }}{{ htmlAttributes($componentHtmlAttributes) }}>
        <source{{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        @lang('bootstrap-components::bootstrap-components.notification.audio')
    </audio>
</div>
