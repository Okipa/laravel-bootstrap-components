<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Closure;
use Okipa\LaravelBootstrapComponents\Components\Form\Traits\MultilingualValidityChecks;
use Throwable;

abstract class MultilingualAbstract extends FormAbstract
{
    use MultilingualValidityChecks;

    /**
     * The multilingual component dynamic multilingual resolver .
     *
     * @property \Okipa\LaravelBootstrapComponents\Components\Form\Multilingual\Resolver $multilingualResolver
     */
    protected $multilingualResolver;

    /**
     * The component language locales to handle.
     *
     * @property array $locales
     */
    protected $locales;

    /**
     * InputMultilingual constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->multilingualResolver = app(config('bootstrap-components.form.multilingualResolver'));
        $this->locales = $this->multilingualResolver->getDefaultLocales();
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
     * @inheritDoc
     */
    public function render(array $extraData = []): string
    {
        if ($this->multilingualMode()) {
            return $this->multilingualRender($extraData);
        }

        return parent::render($extraData);
    }

    /**
     * @return bool
     */
    protected function multilingualMode(): bool
    {
        return count($this->locales) > 1;
    }

    /**
     * @param array $extraData
     *
     * @return string
     * @throws Throwable
     */
    protected function multilingualRender(array $extraData = []): string
    {
        $this->checkValuesValidity();
        $view = $this->getView();
        $html = '';
        foreach ($this->locales as $locale) {
            $componentHtml = $view
                ? (string) view(
                    'bootstrap-components::' . $view,
                    array_merge($this->getLocalizedValues($locale), $extraData)
                )->render()
                : '';
            $html .= trim($componentHtml);
        }

        return $html;
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
        $componentId = $this->getLocalizedComponentId($locale);
        $containerId = $this->getLocalizedContainerId($locale);
        $containerHtmlAttributes = $this->getLocalizedContainerHtmlAttributes($locale);
        $name = $this->getLocalizedName($locale);
        $label = $this->getLocalizedLabel($locale);
        $value = $this->getLocalizedValue($locale);
        $placeholder = $this->getLocalizedPlaceholder($locale);
        $validationClass = $this->getLocalizedValidationClass($locale);
        $errorMessage = $this->getLocalizedErrorMessage($locale);

        return array_merge($parentParams, compact(
            'componentId',
            'containerId',
            'containerHtmlAttributes',
            'name',
            'label',
            'value',
            'placeholder',
            'validationClass',
            'errorMessage'
        ));
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    protected function getLocalizedComponentId(string $locale): string
    {
        return parent::getComponentId() . '-' . $locale;
    }

    /**
     * @param string $locale
     *
     * @return string|null
     */
    protected function getLocalizedContainerId(string $locale): ?string
    {
        return parent::getContainerId() ? parent::getContainerId() . '-' . $locale : null;
    }

    /**
     * @param string $locale
     *
     * @return array
     */
    protected function getLocalizedContainerHtmlAttributes(string $locale): array
    {
        return array_merge(['data-locale' => $locale], parent::getContainerHtmlAttributes());
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    protected function getLocalizedName(string $locale): string
    {
        return $this->multilingualResolver->resolveLocalizedName($this->getName(), $locale);
    }

    /**
     * @param string $locale
     *
     * @return string|null
     */
    protected function getLocalizedLabel(string $locale): ?string
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
        $oldValue = $this->multilingualResolver->resolveLocalizedOldValue($this->getName(), $locale);
        /** @var Closure|null $customValueClosure */
        $customValueClosure = $this->multilingualMode() ? $this->value : null;
        $modelValue = $this->multilingualResolver->resolveLocalizedModelValue(
            $this->getName(),
            $locale,
            $this->getModel()
        );

        return $oldValue ?? ($customValueClosure ? $customValueClosure($locale) : $modelValue);
    }

    /**
     * @param string $locale
     *
     * @return string|null
     */
    protected function getLocalizedPlaceholder(string $locale): ?string
    {
        $placeholder = parent::getPlaceholder();

        return $placeholder ? $placeholder . ' (' . strtoupper($locale) . ')' : null;
    }

    /**
     * @param string $locale
     *
     * @return string|null
     */
    protected function getLocalizedValidationClass(string $locale): ?string
    {
        if (session()->has('errors')) {
            $errorMessageBagKey = $this->multilingualResolver->resolveErrorMessageBagKey($this->getName(), $locale);

            return session()->get('errors')->has($errorMessageBagKey)
                ? ($this->getDisplayFailure() ? 'is-invalid' : null)
                : ($this->getDisplaySuccess() ? 'is-valid' : null);
        }

        return null;
    }

    /**
     * @param string $locale
     *
     * @return string|null
     */
    protected function getLocalizedErrorMessage(string $locale): ?string
    {
        return $this->multilingualResolver->resolveErrorMessage(parent::getName(), $locale);
    }
}
