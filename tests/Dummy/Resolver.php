<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Dummy;

use Illuminate\Database\Eloquent\Model;

class Resolver extends \Okipa\LaravelBootstrapComponents\Form\Multilingual\Resolver
{
    /**
     * @inheritDoc
     */
    protected $locales = ['en', 'de'];

    /**
     * @inheritDoc
     */
    public function resolveLocalizedName(string $name, string $locale): string
    {
        return $name . '_' . $locale;
    }

    /**
     * @inheritDoc
     */
    public function resolveLocalizedOldValue(string $name, string $locale): ?string
    {
        return old($name . '_' . $locale);
    }

    /**
     * @inheritDoc
     */
    public function resolveLocalizedModelValue(string $name, string $locale, ?Model $model): ?string
    {
        return optional($model)->{$name . '_' . $locale};
    }

    /**
     * @inheritDoc
     */
    public function resolveErrorMessageBagKey(string $name, string $locale): string
    {
        return $name . '_' . $locale;
    }
}
