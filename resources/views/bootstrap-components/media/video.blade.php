<div {{ classTag('video-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <video {{ classTag('video-component', $componentClass) }}
        {{ htmlAttributes($componentHtmlAttributes) }}
        {{ htmlAttributes($poster ? 'poster="'.$poster.'"' : null) }}>
        <source {{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        {{ trans('bootstrap-components::bootstrap-components.notification.video') }}
    </video>
</div>
