<div {{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}
    {{ classTag('audio-container', $containerClasses) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <audio {{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}
        {{ classTag('audio-component', $componentClasses) }}
        {{ htmlAttributes($componentHtmlAttributes) }}>
        <source {{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        @lang('bootstrap-components::bootstrap-components.notification.audio')
    </audio>
</div>
