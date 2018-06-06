<div @if(!empty($containerClass))class="{{ renderHtmlClass($containerClass) }}"@endif
    {{ renderHtmlAttributes($containerHtmlAttributes) }}>
    <video @if(!empty($componentClass))class="{{ renderHtmlClass($componentClass) }}" @endif
    {{ renderHtmlAttributes($componentHtmlAttributes) }}
    @isset($poster)poster="{{ $poster }}"@endisset>
        <source src="{{ $src }}">
        @lang('component.warning.video')
    </video>
</div>
