<div {{ classTag($type . '-' . str_slug($name) . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    <div class="input-group">
        @include('bootstrap-components::bootstrap-components.partials.icon')
        <input id="{{ $type }}-{{ str_slug($name) }}"
               {{ classTag('form-control', $type . '-' . str_slug($name) . '-component', $componentClass, validationStatus($name)) }}
               type="{{ $type }}"
               name="{{ $name }}"
               value="{{ old($name, $value) }}"
               placeholder="{{ $placeholder }}"
               {{ htmlAttributes($componentHtmlAttributes) }}
               aria-label="{{ $label }}"
               aria-describedby="{{ $type }}-{{ str_slug($name) }}">
    </div>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>

