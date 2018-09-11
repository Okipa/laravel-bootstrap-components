<div {{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}
    {{ classTag('audio-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <audio {{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}
        {{ classTag('audio-component', $componentClass) }}
        {{ htmlAttributes($componentHtmlAttributes) }}>
        <source {{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        {{ trans('bootstrap-components::bootstrap-components.notification.audio') }}
    </audio>
</div>
