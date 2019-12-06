<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag($htmlIdentifier . '-container', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    @if($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endif
    @if(! empty($prepend) || ! empty($append))
        <div class="input-group">
    @endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <textarea id="{{ $componentId }}" name="{{ $name }}"{{ classTag('form-control', $htmlIdentifier . '-component', $componentClasses, $validationClass) }}{{ htmlAttributes($placeholder ? ['placeholder' => $placeholder] : null, $componentHtmlAttributes) }} aria-label="{{ $label }}" aria-describedby="{{ $htmlIdentifier }}">{{ old($name, $value) }}</textarea>
        @include('bootstrap-components::bootstrap-components.partials.append')
    @if(! empty($prepend) || ! empty($append))
        </div>
    @endif
    @unless($labelPositionedAbove)
        @include('bootstrap-components::bootstrap-components.partials.label')
    @endunless
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
