<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Fakers;

use Illuminate\Database\Eloquent\Model;

class Resolver extends \Okipa\LaravelBootstrapComponents\Form\Multilingual\Resolver
{
    /*
     * The language locales to handle for multilingual components.
     *
     * @property array $locales
     */
    protected $locales = ['en', 'de'];

    /**
     * Resolve the multilingual component localized name.
     *
     * @param string $name
     * @param string $locale
     *
     * @return string
     */
    public function resolveLocalizedName(string $name, string $locale): string
    {
        return $name . '_' . $locale;
    }

    /**
     * Resolve the multilingual component localized old value.
     *
     * @param string $name
     * @param string $locale
     * @return string|null
     */
    public function resolveLocalizedOldValue(string $name, string $locale): ?string
    {
        return old($name . '_' . $locale);
    }

    /**
     * Resolve the multilingual component localized value.
     *
     * @param string $name
     * @param string $locale
     * @param Model $model |null
     *
     * @return string|null
     */
    public function resolveLocalizedModelValue(string $name, string $locale, ?Model $model): ?string
    {
        return optional($model)->{$name . '_' . $locale};
    }

    /**
     * Resolve the multilingual component localized error message bag key.
     *
     * @param string $name
     * @param string $locale
     *
     * @return string
     */
    public function resolveErrorMessageBagKey(string $name, string $locale): string
    {
        return $name . '_' . $locale;
    }
}
