<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Closure;
use Okipa\LaravelBootstrapComponents\Components\Form\Multilingual\Resolver;
use Okipa\LaravelBootstrapComponents\Components\Form\Traits\MultilingualValidityChecks;

abstract class MultilingualAbstract extends FormAbstract
{
    use MultilingualValidityChecks;

    protected Resolver $multilingualResolver;

    protected array $locales;

    public function __construct()
    {
        parent::__construct();
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Multilingual\Resolver $multilingualResolver */
        $multilingualResolver = app(config('bootstrap-components.form.multilingualResolver'));
        $this->locales = $multilingualResolver->getDefaultLocales();
        $this->multilingualResolver = $multilingualResolver;
    }

    public function locales(array $locales): self
    {
        $this->locales = $locales;

        return $this;
    }

    public function render(array $extraData = []): string
    {
        if ($this->multilingualMode()) {
            return $this->multilingualRender($extraData);
        }

        return parent::render($extraData);
    }

    protected function multilingualMode(): bool
    {
        return count($this->locales) > 1;
    }

    /**
     * @param array $extraData
     *
     * @return string
     * @throws \Throwable
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

    protected function getLocalizedValues(string $locale): array
    {
        return array_merge($this->getValues(), $this->getLocalizedParameters($locale));
    }

    protected function getLocalizedParameters(string $locale): array
    {
        $parentParams = $this->getParameters();
        $componentId = $this->getLocalizedComponentId($locale);
        $containerId = $this->getLocalizedContainerId($locale);
        $componentHtmlAttributes = $this->getLocalizedComponentHtmlAttributes($locale);
        $name = $this->getLocalizedName($locale);
        $prepend = $this->getLocalizedPrepend($locale);
        $append = $this->getLocalizedAppend($locale);
        $label = $this->getLocalizedLabel($locale);
        $value = $this->getLocalizedValue($locale);
        $placeholder = $this->getLocalizedPlaceholder($locale);
        $validationClass = $this->getLocalizedValidationClass($locale);
        $errorMessage = $this->getLocalizedErrorMessage($locale);

        return array_merge($parentParams, compact(
            'componentId',
            'containerId',
            'componentHtmlAttributes',
            'name',
            'prepend',
            'append',
            'label',
            'value',
            'placeholder',
            'validationClass',
            'errorMessage'
        ));
    }

    protected function getLocalizedComponentId(string $locale): string
    {
        return $this->getComponentId() . '-' . $locale;
    }

    protected function getLocalizedContainerId(string $locale): ?string
    {
        return $this->getContainerId() ? $this->getContainerId() . '-' . $locale : null;
    }

    protected function getLocalizedComponentHtmlAttributes(string $locale): array
    {
        return array_merge(['data-locale' => $locale], $this->getComponentHtmlAttributes());
    }

    protected function getLocalizedName(string $locale): string
    {
        return $this->multilingualResolver->resolveLocalizedName($this->getName(), $locale);
    }

    protected function getLocalizedPrepend(string $locale): ?string
    {
        $prepend = $this->prepend;

        // fallback for usage of closure with multilingual disabled
        return $prepend instanceof Closure ? $prepend($locale) : $prepend;
    }

    protected function getLocalizedAppend(string $locale): ?string
    {
        $append = $this->append;

        // fallback for usage of closure with multilingual disabled
        return $append instanceof Closure ? $append($locale) : $append;
    }

    protected function getLocalizedLabel(string $locale): ?string
    {
        $label = $this->getLabel();

        return $label ? $label . ' (' . mb_strtoupper($locale) . ')' : null;
    }

    protected function getLocalizedValue(string $locale)
    {
        $oldValue = $this->multilingualResolver->resolveLocalizedOldValue($this->getName(), $locale);
        /** @var Closure|null $valueClosure */
        $valueClosure = $this->multilingualMode() ? $this->value : null;
        $modelValue = $this->multilingualResolver->resolveLocalizedModelValue(
            $this->getName(),
            $locale,
            $this->getModel()
        );

        return $oldValue ?? ($valueClosure ? $valueClosure($locale) : $modelValue);
    }

    protected function getLocalizedPlaceholder(string $locale): ?string
    {
        $placeholder = $this->getPlaceholder();

        return $placeholder ? $placeholder . ' (' . mb_strtoupper($locale) . ')' : null;
    }

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

    protected function getLocalizedErrorMessage(string $locale): ?string
    {
        return $this->multilingualResolver->resolveErrorMessage(parent::getName(), $locale);
    }
}
