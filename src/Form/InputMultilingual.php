<?php

namespace Okipa\LaravelBootstrapComponents\Form;

abstract class InputMultilingual extends Input
{
    /**
     * The component language locales to manage.
     *
     * @property array|false $locales
     */
    protected $locales;

    /**
     * Set the component input language locales to manage.
     *
     * @param array $locales
     *
     * @return $this
     */
    public function locales(array $locales): self
    {
        $this->locales = $locales;

        return $this;
    }

    /**
     * Render the component html.
     *
     * @param array $extraData
     *
     * @return string|null
     * @throws \Throwable
     */
    public function render(array $extraData = []): ?string
    {
        $locales = $this->getLocales();
        $this->checkValuesValidity();
        $view = $this->getView();
        if ($view) {
            return ! empty($locales)
                ? (string) trim(view('bootstrap-components::bootstrap-components.partials.multilingual.displayer', [
                    'locales' => $locales,
                    'view' => $view,
                    'values' => array_merge($this->values(), $extraData),
                ])->render())
                : parent::render($extraData);
        }
    }

    /**
     * @return array
     */
    protected function getLocales(): array
    {
        return $this->locales ?? config('bootstrap-components.' . $this->configKey . '.locales', []);
    }

    /**
     * Define the component values.
     *
     * @return array
     */
    protected function defineValues(): array
    {
        $locale = null;

        return array_merge(parent::values(), compact('locale'));
    }
}
