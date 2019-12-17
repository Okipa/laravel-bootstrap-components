<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    <a{{ htmlAttributes($linkId ? ['id' => $linkId] : null) }}{{ htmlAttributes($linkUrl ? 'href="' . $linkUrl . '"' : null) }}{{ classTag('link', $linkClasses) }}{{ htmlAttributes($linkHtmlAttributes) }}{{ htmlAttributes($alt ? 'title="' . $alt . '"' : null) }}>
        <img{{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}{{ classTag('component', $componentClasses) }}{{ htmlAttributes($width ? 'width="' . $width . '"' : null) }}{{ htmlAttributes($height ? 'height="' . $height . '"' : null) }}{{ htmlAttributes($componentHtmlAttributes) }}{{ htmlAttributes($src ? 'src="' . $src . '"' : null) }}{{ htmlAttributes($alt ? 'alt="' . $alt . '"' : null) }}>
    </a>
</div>
