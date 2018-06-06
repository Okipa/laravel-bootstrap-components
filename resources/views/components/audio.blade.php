<div @if(!empty($containerClass))class="{{ renderHtmlClass($containerClass) }}"@endif
    {{ renderHtmlAttributes($containerHtmlAttributes) }}>
    <audio @if(!empty($componentClass))class="{{ renderHtmlClass($componentClass) }}" @endif
    {{ renderHtmlAttributes($componentHtmlAttributes) }}>
        <source src="{{ $src }}">
        @lang('component.warning.audio')
    </audio>
</div>
