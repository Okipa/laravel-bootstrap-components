<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Multilingual;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;

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
        if (! old($name)) {
            return null;
        }
        $oldLocalizedValue = data_get(old($name), $locale);
        if ($oldLocalizedValue) {
            return $oldLocalizedValue;
        }

        return array_key_exists($locale, old($name)) ? '' : null;
    }

    public function resolveLocalizedModelValue(string $name, string $locale, ?Model $model): ?string
    {
        return data_get($model, "$name.$locale");
    }

    public function resolveErrorMessage(string $name, MessageBag $errors, string $locale): ?string
    {
        $errorMessageBagKey = $this->resolveErrorMessageBagKey($name, $locale);
        $errorMessage = $errors->first($errorMessageBagKey);
        $errorMessage = $this->undoInputNameLaravelUnderscoreRemovalInErrorMessage($name, $locale, $errorMessage);

        return $errorMessage
            ? str_replace(
                $errorMessageBagKey,
                __('validation.attributes.' . $name) . ' (' . strtoupper($locale) . ')',
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
