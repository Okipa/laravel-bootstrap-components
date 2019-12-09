<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Illuminate\Database\Eloquent\Model;

class MultilingualResolver
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
     * @param $locale
     * @return string|null
     */
    public function resolveLocalizedOldValue(string $name, $locale): ?string
    {
        return data_get(old($name), $locale);
    }

    /**
     * Resolve the multilingual component localized value.
     *
     * @param string $name
     * @param string $locale
     * @param Model|null $model
     *
     * @return string|null
     */
    public function resolveLocalizedValue(string $name, string $locale, ?Model $model): ?string
    {
        return optional($model)->{$name};
    }

    /**
     * Resolve the multilingual component localized html identifier.
     *
     * @param string $type
     * @param string $name
     *
     * @param string $locale
     * @return string
     */
    public function resolveHtmlIdentifier(string $type, string $name, string $locale): string
    {
        return $type . '-' . $name . '-' . $locale;
    }

    /**
     * Get the multilingual component localized error message bag key.
     *
     * @param string $name
     * @param string $locale
     *
     * @return string
     */
    protected function getErrorMessageBagKey(string $name, string $locale): string
    {
        return $name . '.' . $locale;
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
        $errorMessageBagKey = $this->getErrorMessageBagKey($name, $locale);
        $errorMessage = optional(session()->get('errors'))->first($errorMessageBagKey);

        return $errorMessage
            ? str_replace(
                $errorMessageBagKey,
                __('validation.attributes.' . $name) . ' (' . strtoupper($locale) . ')',
                $errorMessage
            )
            : null;
    }
}
