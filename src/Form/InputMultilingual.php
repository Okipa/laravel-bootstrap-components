<?php

namespace Okipa\LaravelBootstrapComponents\Form;

abstract class InputMultilingual extends Input
{
    /**
     * The component language locales to handle.
     *
     * @property array|false $locales
     */
    protected $locales;

    /**
     * Set the component input language locales to handle.
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
        dd('hej');
        if (count($this->getLocales())) {
            return $this->multilingualRender($extraData);
        }

        return parent::render($extraData);
    }

    /**
     * @return array
     */
    protected function getLocales(): array
    {
        return $this->locales ?? config('bootstrap-components.' . $this->configKey . '.locales', []);
    }

    /**
     * @param array $extraData
     *
     * @return string|null
     * @throws \Throwable
     */
    protected function multilingualRender(array $extraData = []): ?string
    {
        $this->checkValuesValidity();
        $view = $this->getView();
        if ($view) {
            return (string) trim(view('bootstrap-components::bootstrap-components.partials.multilingual', [
                'locales' => $this->getLocales(),
                'view' => $view,
                'values' => array_merge($this->values(), $extraData),
            ])->render());
        }
    }

    /**
     * Define the component values.
     *
     * @return array
     */
    protected function defineValues(): array
    {
        return array_merge(parent::values(), ['locale' => null]);
    }
}
