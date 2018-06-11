<div {{ classTag($containerClass) }}
    {{ htmlAttributes($containerHtmlAttributes) }}>
    <video {{ classTag($componentClass) }}
    {{ htmlAttributes($componentHtmlAttributes) }}
    @isset($poster)poster="{{ $poster }}"@endisset>
        <source src="{{ $src }}">
        @lang('component.warning.video')
    </video>
</div>
