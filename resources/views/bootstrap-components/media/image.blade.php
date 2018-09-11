<div {{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}
    {{ classTag('image-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <a {{ htmlAttributes($linkId ? ['id' => $linkId] : null) }}
        {{ htmlAttributes($linkUrl ? 'href="'.$linkUrl.'"' : null) }}
        {{ classTag('image-link', $linkClass) }}
        {{ htmlAttributes($linkHtmlAttributes) }}
        {{ htmlAttributes($alt ? 'title="'.$alt.'"' : null) }}>
        <img {{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}
            {{ classTag('image-component', $componentClass) }}
            {{ htmlAttributes($width ? 'width="'.$width.'"' : null) }}
            {{ htmlAttributes($height ? 'height="'.$height.'"' : null) }}
            {{ htmlAttributes($componentHtmlAttributes) }}
            {{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}
            {{ htmlAttributes($alt ? 'alt="'.$alt.'"' : null) }}>
    </a>
</div>
