<div{{ html_attributes($containerId ? ['id' => $containerId] : null) }}{{ html_classes('component-container', $containerClasses) }}{{ html_attributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label', ['labelClasses' => ['d-block']])
    <a{{ html_attributes($linkId ? ['id' => $linkId] : null) }}{{ html_attributes($linkUrl ? ['href' => $linkUrl] : null) }}{{ html_attributes($linkTitle ? ['title' => $linkTitle] : null) }}{{ html_classes('component-link', $linkClasses) }}{{ html_attributes($linkHtmlAttributes) }}>
        <img{{ html_attributes($componentId ? ['id' => $componentId] : null) }}{{ html_classes('component', $componentClasses) }}{{ html_attributes($width ? ['width' => $width] : null) }}{{ html_attributes($height ? ['height' => $height] : null) }}{{ html_attributes($src ? ['src' => $src] : null) }}{{ html_attributes($alt ? ['alt' => $alt] : null) }}{{ html_attributes($componentHtmlAttributes) }}>
    </a>
    @include('bootstrap-components::bootstrap-components.partials.caption')
</div>
