@foreach($locales as $locale)
    {{ dd($locale) }}
    @include('bootstrap-components::' . $view, array_merge($values, compact('locale')))
@endforeach
