<div {{ classTag('audio-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <audio {{ classTag('audio-component', $componentClass) }}
    {{ htmlAttributes($componentHtmlAttributes) }}>
        <source {{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        {{ trans('bootstrap-components::bootstrap-components.notification.audio') }}
    </audio>
</div>
