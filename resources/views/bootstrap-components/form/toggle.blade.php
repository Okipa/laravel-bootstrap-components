<div{{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}{{ classTag($htmlIdentifier . '-container', 'switch', 'custom-control', $containerClasses) }}{{ htmlAttributes($containerHtmlAttributes) }}>
    <input id="{{ $componentId }}"{{ classTag($htmlIdentifier . '-component', 'custom-control-input', $componentClasses, $validationClass) }} type="checkbox" name="{{ $name }}"{{ htmlAttributes($componentHtmlAttributes) }}>
    <label class="custom-control-label" for="{{ $componentId }}">@if(! empty($prepend))<span class="label-prepend">{!! $prepend !!}</span> @endif{{ __($label) }}@if(! empty($append))<span class="label-append">{!! $append !!}</span> @endif</label>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
