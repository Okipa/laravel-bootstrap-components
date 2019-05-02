<div {{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}
    {{ classTag('video-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <video {{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}
        {{ classTag('video-component', $componentClass) }}
        {{ htmlAttributes($componentHtmlAttributes) }}
        {{ htmlAttributes($poster ? 'poster="'.$poster.'"' : null) }}>
        <source {{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        @lang('bootstrap-components::bootstrap-components.notification.video')
    </video>
</div>
