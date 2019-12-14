<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $htmlIdentifier, $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    <video{{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}{{ classTag('component', $htmlIdentifier, $componentClasses) }}{{ htmlAttributes($componentHtmlAttributes) }}{{ htmlAttributes($poster ? 'poster="'.$poster.'"' : null) }}>
        <source{{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        @lang('bootstrap-components::bootstrap-components.notification.video')
    </video>
</div>
