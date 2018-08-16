<div {{ classTag($type . '-' . str_slug($name) . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    <div class="input-group">
        @include('bootstrap-components::bootstrap-components.partials.icon')
        <textarea id="{{ $type }}-{{ str_slug($name) }}"
               name="{{ $name }}"
               {{ classTag('form-control', $type . '-' . str_slug($name) . '-component', $componentClass, validationStatus($name)) }}
               placeholder="{{ $placeholder }}"
               {{ htmlAttributes($componentHtmlAttributes) }}
               aria-label="{{ $label }}"
               aria-describedby="{{ $type }}-{{ str_slug($name) }}">{{ old($name, $value) }}</textarea>
    </div>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
