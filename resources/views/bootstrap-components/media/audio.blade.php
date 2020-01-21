<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label', ['labelClasses' => ['d-block']])
    <audio{{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}{{ classTag('component', $componentClasses) }}{{ htmlAttributes($componentHtmlAttributes) }}>
        <source{{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        @lang('Your browser does not support the :tag HTML5 tag.', ['tag' => 'audio'])
    </audio>
    @include('bootstrap-components::bootstrap-components.partials.caption')
</div>
