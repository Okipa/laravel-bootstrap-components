<div {{ classTag('video-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <video {{ classTag('video-component', $componentClass) }}
        {{ htmlAttributes($componentHtmlAttributes) }}
        {{ htmlAttributes($poster ? 'poster="'.$poster.'"' : null) }}>
        <source {{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        @lang('bootstrap-components::component.warning.video')
    </video>
</div>
