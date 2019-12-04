@foreach($locales as $locale)
    @include('bootstrap-components::' . $view, array_merge($values, compact('locale')))
@endforeach
