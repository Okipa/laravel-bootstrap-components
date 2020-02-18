<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Multilingual;

use Illuminate\Database\Eloquent\Model;

class Resolver
{
    /*
     * The language locales to handle for multilingual components.
     *
     * @property array $locales
     */
    protected $locales = [];

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
     * Resolve the multilingual component localized name.
     *
     * @param string $name
     * @param string $locale
     *
     * @return string
     */
    public function resolveLocalizedName(string $name, string $locale): string
    {
        return $name . '[' . $locale . ']';
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
        return data_get(old($name), $locale);
    }

    /**
     * Resolve the multilingual component localized model value.
     *
     * @param string $name
     * @param string $locale
     * @param Model|null $model
     *
     * @return string|null
     */
    public function resolveLocalizedModelValue(string $name, string $locale, ?Model $model): ?string
    {
        return data_get(optional($model)->{$name}, $locale);
    }

    /**
     * Resolve the multilingual component localized error message.
     *
     * @param string $name
     * @param string $locale
     *
     * @return string|null
     */
    public function resolveErrorMessage(string $name, string $locale): ?string
    {
        $errorMessageBagKey = $this->resolveErrorMessageBagKey($name, $locale);
        $errorMessage = optional(session()->get('errors'))->first($errorMessageBagKey);

        return $errorMessage
            ? str_replace(
                $errorMessageBagKey,
                ((string) __('validation.attributes.' . $name)) . ' (' . strtoupper($locale) . ')',
                $errorMessage
            )
            : null;
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
        return $name . '.' . $locale;
    }
}
