<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Closure;
use InvalidArgumentException;

abstract class InputMultilingual extends Input
{
    /**
     * The component language locales to handle.
     *
     * @property array|false $locales
     */
    protected $locales;

    /**
     * Set the component input value.
     *
     * @param mixed $value
     *
     * @return $this
     * @throws \Exception
     */
    public function value($value): parent
    {
        if (count($this->getLocales()) > 1 && ! $value instanceof Closure) {
            throw new InvalidArgumentException('A multilingual component value has to be set from this
            closure result : « value(function($locale){}) ».');
        }
        $this->value = $value;

        return $this;
    }

    /**
     * @return array
     */
    protected function getLocales(): array
    {
        return $this->locales ?? config('bootstrap-components.' . $this->configKey . '.locales', []);
    }

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
        if (count($this->getLocales()) > 1) {
            return $this->multilingualRender($extraData);
        }

        return parent::render($extraData);
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
            $html = '';
            foreach ($this->getLocales() as $locale) {
                $html .= (string)trim(view(
                    'bootstrap-components::' . $view,
                    array_merge($this->getLocalizedValues($locale), $extraData)
                )->render());
            }

            return $html;
        }
    }

    /**
     * Set the localized values for the view.
     *
     * @param string $locale
     *
     * @return array
     */
    protected function getLocalizedValues(string $locale): array
    {
        return array_merge(parent::getValues(), $this->getLocalizedParameters($locale));
    }

    /**
     * Define the component parameters.
     *
     * @param string $locale
     *
     * @return array
     */
    protected function getLocalizedParameters(string $locale): array
    {
        $parentParams = parent::getParameters();
        $name = $this->getLocalizedName($locale);
        $label = $this->getLocalizedLabel($locale);
        $value = $this->getLocalizedValue($locale);
        $placeholder = $this->getLocalizedPlaceholder($locale);
        $containerId = $this->getLocalizedContainerId($locale);
        $componentId = $this->getLocalizedComponentId($locale);

        return array_merge($parentParams, compact('name', 'label', 'value', 'placeholder', 'containerId', 'componentId'));
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    protected function getLocalizedName(string $locale): string
    {
        return $this->getName() . '[' . $locale . ']';
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    protected function getLocalizedLabel(string $locale): string
    {
        $label = parent::getLabel();

        return $label ? $label . ' (' . strtoupper($locale) . ')' : null;
    }

    /**
     * @param string $locale
     *
     * @return mixed
     */
    protected function getLocalizedValue(string $locale)
    {
        $value = parent::getValue();

        return $value instanceof Closure ? $value($locale) : data_get($value, $locale);
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    protected function getLocalizedPlaceholder(string $locale): string
    {
        $placeholder = parent::getPlaceholder();

        return $placeholder ? $placeholder . ' (' . strtoupper($locale) . ')' : null;
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    protected function getLocalizedContainerId(string $locale): string
    {
        $containerId = parent::getContainerId();

        return $containerId
            ? $containerId . '-' . $locale
            : ($this->type . '-' . $this->getName() . '-' . $locale . '-container');
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    protected function getLocalizedComponentId(string $locale): string
    {
        $componentId = parent::getComponentId();

        return $componentId ? $componentId . '-' . $locale : null;
    }
}
