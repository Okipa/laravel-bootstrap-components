<div {{ classTag($id . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    <div class="input-group">
        @include('bootstrap-components::bootstrap-components.partials.icon')
        <input id="{{ $id }}"
               {{ classTag('form-control', $id . '-component', $componentClass, validationStatus($name)) }}
               type="{{ $type }}"
               name="{{ $name }}"
               value="{{ old($name, $value) }}"
               placeholder="{{ $placeholder }}"
               {{ htmlAttributes($componentHtmlAttributes) }}
               aria-label="{{ $label }}"
               aria-describedby="{{ $id }}">
    </div>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>

