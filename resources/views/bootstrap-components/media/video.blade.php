<div{{ html_attributes($containerId ? ['id' => $containerId] : null) }}{{ html_classes('component-container', $containerClasses) }}{{ html_attributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label', ['labelClasses' => ['d-block']])
    <video{{ html_attributes($componentId ? ['id' => $componentId] : null) }}{{ html_classes('component', $componentClasses) }}{{ html_attributes($poster ? 'poster="'.$poster.'"' : null) }}{{ html_attributes($componentHtmlAttributes) }}>
        <source{{ html_attributes($src ? 'src="'.$src.'"' : null) }}>
        @lang('Your browser does not support the :tag HTML5 tag.', ['tag' => 'video'])
    </video>
    @include('bootstrap-components::bootstrap-components.partials.caption')
</div>
