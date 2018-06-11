<div {{ classTag($containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <audio {{ classTag($componentClass) }}
    {{ htmlAttributes($componentHtmlAttributes) }}>
        <source src="{{ $src }}">
        @lang('component.warning.audio')
    </audio>
</div>
