<?php

namespace Okipa\LaravelBootstrapComponents\Test\Fakers;

use Illuminate\Support\Str;

class MultilingualResolver extends \Okipa\LaravelBootstrapComponents\Form\MultilingualResolver
{
    /*
     * The language locales to handle for multilingual components.
     *
     * @property array $locales
     */
    protected $locales = ['en', 'de'];

    /**
     * Get the default language locales to handle for multilingual components.
     *
     * @return array
     */
    public function getDefaultLocales(): array
    {
        return $this->locales;
    }

    /**
     * Resolve the multilingual component name.
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
     * Resolve the multilingual component html identifier.
     *
     * @param string $type
     * @param string $name
     *
     * @return string
     */
    public function resolveHtmlIdentifier(string $type, string $name): string
    {
        return $type . '-' . Str::slug($name);
    }

    /**
     * Resolve the multilingual component error message bag name.
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
