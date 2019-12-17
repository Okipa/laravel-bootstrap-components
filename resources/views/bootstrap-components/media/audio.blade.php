<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    <audio{{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}{{ classTag('component', $componentClasses) }}{{ htmlAttributes($componentHtmlAttributes) }}>
        <source{{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        @lang('bootstrap-components::bootstrap-components.notification.audio')
    </audio>
</div>
