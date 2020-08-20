<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Multilingual;

use Illuminate\Database\Eloquent\Model;

class Resolver
{
    protected array $locales = [];

    public function getDefaultLocales(): array
    {
        return $this->locales;
    }

    public function resolveLocalizedName(string $name, string $locale): string
    {
        return $name . '[' . $locale . ']';
    }

    public function resolveLocalizedOldValue(string $name, string $locale): ?string
    {
        return data_get(old($name), $locale);
    }

    public function resolveLocalizedModelValue(string $name, string $locale, ?Model $model): ?string
    {
        return data_get(optional($model)->{$name}, $locale);
    }

    public function resolveErrorMessage(string $name, string $locale): ?string
    {
        $errorMessageBagKey = $this->resolveErrorMessageBagKey($name, $locale);
        $errorMessage = optional(session()->get('errors'))->first($errorMessageBagKey);
        $errorMessage = $this->undoInputNameLaravelUnderscoreRemovalInErrorMessage($name, $locale, $errorMessage);

        return $errorMessage
            ? str_replace(
                $errorMessageBagKey,
                ((string) __('validation.attributes.' . $name)) . ' (' . strtoupper($locale) . ')',
                $errorMessage
            )
            : null;
    }

    public function resolveErrorMessageBagKey(string $name, string $locale): string
    {
        return $name . '.' . $locale;
    }

    /**
     * @param string $name
     * @param string $locale
     * @param string|null $errorMessage
     *
     * @return string|null
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function undoInputNameLaravelUnderscoreRemovalInErrorMessage(
        string $name,
        string $locale,
        ?string $errorMessage
    ): ?string {
        if (! $errorMessage) {
            return null;
        }
        $inputNameWithoutUnderscore = str_replace('_', ' ', $name);

        return str_replace($inputNameWithoutUnderscore, $name, $errorMessage);
    }
}
