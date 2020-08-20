<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Dummy;

use Illuminate\Database\Eloquent\Model;

class Resolver extends \Okipa\LaravelBootstrapComponents\Components\Form\Multilingual\Resolver
{
    protected array $locales = ['en', 'de'];

    public function resolveLocalizedOldValue(string $name, string $locale): ?string
    {
        return old($name . '_' . $locale);
    }

    public function resolveLocalizedModelValue(string $name, string $locale, ?Model $model): ?string
    {
        return optional($model)->{$name . '_' . $locale};
    }

    public function resolveErrorMessageBagKey(string $name, string $locale): string
    {
        return $name . '_' . $locale;
    }

    protected function undoInputNameLaravelUnderscoreRemovalInErrorMessage(
        string $name,
        string $locale,
        ?string $errorMessage
    ): ?string {
        if (! $errorMessage) {
            return null;
        }
        $inputNameWithoutUnderscore = str_replace('_', ' ', $this->resolveLocalizedName($name, $locale));

        return str_replace($inputNameWithoutUnderscore, $this->resolveLocalizedName($name, $locale), $errorMessage);
    }

    public function resolveLocalizedName(string $name, string $locale): string
    {
        return $name . '_' . $locale;
    }
}
