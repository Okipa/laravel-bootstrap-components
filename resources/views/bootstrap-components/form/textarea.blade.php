<div {{ classTag($id . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    <div class="input-group">
        @include('bootstrap-components::bootstrap-components.partials.icon')
        <textarea id="{{ $id }}"
               name="{{ $name }}"
               {{ classTag('form-control', $id . '-component', $componentClass, validationStatus($name)) }}
               placeholder="{{ $placeholder }}"
               {{ htmlAttributes($componentHtmlAttributes) }}
               aria-label="{{ $label }}"
               aria-describedby="{{ $id }}">{{ old($name, $value) }}</textarea>
    </div>
    @include('bootstrap-components::bootstrap-components.partials.validation-feedback')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
