<div {{ classTag($type . '-' . $name . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    <div class="input-group">
        @include('bootstrap-components::bootstrap-components.partials.icon')
        <textarea id="{{ $type }}-{{ $name }}"
               name="{{ $name }}"
               {{ classTag('form-control', $type . '-' . $name . '-component', $componentClass, isset($errors) && $errors->has($name) ? ' is-invalid' : null) }}
               placeholder="{{ $placeholder }}"
               {{ htmlAttributes($componentHtmlAttributes) }}
               aria-label="{{ $label }}"
               aria-describedby="{{ $type }}-{{ $name }}">{{ old($name, $value) }}</textarea>
    </div>
    @include('bootstrap-components::bootstrap-components.partials.error')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
