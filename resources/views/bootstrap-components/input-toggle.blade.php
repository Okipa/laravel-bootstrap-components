<div {{ classTag($type . '-' . $name . '-container', $containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    @include('bootstrap-components::bootstrap-components.partials.label')
    <div {{ classTag('form-control', $type . '-' . $name . '-component', $componentClass, isset($errors) && $errors->has($name) ? ' is-invalid' : null) }}
        {{ htmlAttributes($componentHtmlAttributes) }}>
        {{ toggleSwitchButton()->name($name)->checked(old($name, $checked))->icon($icon)->label($placeholder) }}
    </div>
    @include('bootstrap-components::bootstrap-components.partials.error')
    @include('bootstrap-components::bootstrap-components.partials.legend')
</div>
