<div{{ html_attributes($containerId ? ['id' => $containerId] : null) }}{{ html_classes('component-container', $containerClasses) }}{{ html_attributes($containerHtmlAttributes) }}>

    <form id="{{ $componentId }}"{{ html_classes('component', $componentClasses) }}{{ html_attributes($method ? ['action' => $method] : null) }}{{ html_attributes($action ? ['action' => $action] : null) }}{{ html_attributes( $enctype ? ['enctype' => $enctype] : null) }}{{ html_attributes($componentHtmlAttributes) }}>

    </form>

    @if($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endif
    @if(! empty($prepend) || ! empty($append))
        <div class="input-group">
    @endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <input id="{{ $componentId }}"{{ html_classes('component', 'form-control', $componentClasses, $validationClass($errors ?? null, $locale ?? null)) }} type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"{{ html_attributes($placeholder ? ['placeholder' => $placeholder] : null, $componentHtmlAttributes) }}>
        @include('bootstrap-components::bootstrap-components.partials.append')
        @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @if(! empty($prepend) || ! empty($append))
        </div>
    @endif
    @unless($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endunless
    @include('bootstrap-components::bootstrap-components.partials.caption')
</div>
