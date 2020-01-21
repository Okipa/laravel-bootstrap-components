<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag('component-container', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label', ['labelClasses' => ['d-block']])
    <video{{ htmlAttributes($componentId ? ['id' => $componentId] : null) }}{{ classTag('component', $componentClasses) }}{{ htmlAttributes($poster ? 'poster="'.$poster.'"' : null) }}{{ htmlAttributes($componentHtmlAttributes) }}>
        <source{{ htmlAttributes($src ? 'src="'.$src.'"' : null) }}>
        @lang('Your browser does not support the :tag HTML5 tag.', ['tag' => 'video'])
    </video>
    @include('bootstrap-components::bootstrap-components.partials.caption')
</div>
