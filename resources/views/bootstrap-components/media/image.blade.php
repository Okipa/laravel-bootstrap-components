<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', 'form-group', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    <a{{ htmlAttributes($linkId ? ['id' => $linkId] : null) }}{{ htmlAttributes($linkUrl ? 'href="' . $linkUrl . '"' : null) }}{{ classTag('component-link', $linkClasses) }}{{ htmlAttributes($alt ? 'title="' . $alt . '"' : null) }}{{ htmlAttributes($linkHtmlAttributes) }}>
        <img{{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}{{ classTag('component', $componentClasses) }}{{ htmlAttributes($width ? 'width="' . $width . '"' : null) }}{{ htmlAttributes($height ? 'height="' . $height . '"' : null) }}{{ htmlAttributes($src ? 'src="' . $src . '"' : null) }}{{ htmlAttributes($alt ? 'alt="' . $alt . '"' : null) }}{{ htmlAttributes($componentHtmlAttributes) }}>
    </a>
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
