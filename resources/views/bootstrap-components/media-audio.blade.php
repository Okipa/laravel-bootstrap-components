<div {{ classTag('audio-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <audio {{ classTag('audio-component', $componentClass) }}
    {{ htmlAttributes($componentHtmlAttributes) }}>
        <source {{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        @lang('bootstrap-components::component.warning.audio')
    </audio>
</div>
