<div {{ htmlAttributes($containerId ? ['id' => $containerId] : null) }}
    {{ classTag($type . '-' . Str::slug($name) . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    @if(! empty($prepend) || ! empty($append))
        <div class="input-group">
    @endif
        @include('bootstrap-components::bootstrap-components.partials.prepend')
        <textarea id="{{ $componentId }}"
               name="{{ $name }}"
               {{ classTag('form-control', $type . '-' . Str::slug($name) . '-component', $componentClass, validationStatus($name)) }}
               {{ htmlAttributes(
                   ! empty($placeholder) ? ['placeholder' => $placeholder] : null,
                   $componentHtmlAttributes
               ) }}
               aria-label="{{ $label }}"
               aria-describedby="{{ $type }}-{{ Str::slug($name) }}">{{ old($name, $value) }}</textarea>
        @include('bootstrap-components::bootstrap-components.partials.append')
    @if(! empty($prepend) || ! empty($append))
        </div>
    @endif
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
