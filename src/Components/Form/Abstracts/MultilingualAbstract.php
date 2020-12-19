<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Closure;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelBootstrapComponents\Components\Form\Multilingual\Resolver;

abstract class MultilingualAbstract extends InputAbstract
{
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
                    array_merge($this->getLocalizedViewParams($locale), $extraData)
                )->render()
                : '';
            $html .= trim($componentHtml);
        }

        return $html;
    }

    protected function getLocalizedViewParams(string $locale): array
    {
        return [
            'component' => $this,
            'locale' => $locale,
            'containerId' => $this->getLocalizedContainerId($locale),
            'containerClasses' => $this->getContainerClasses(),
            'containerHtmlAttributes' => $this->getContainerHtmlAttributes(),
            'componentId' => $this->getLocalizedComponentId($locale),
            'componentClasses' => $this->getComponentClasses(),
            'componentHtmlAttributes' => $this->getLocalizedComponentHtmlAttributes($locale),
            'validationClass' => fn(
                ?ViewErrorBag $errors,
                ?string $locale
            ) => $this->getLocalizedValidationClass($errors, $locale),
            'errorMessage' => fn(
                ?ViewErrorBag $errors,
                ?string $locale
            ) => $this->getLocalizedErrorMessage($errors, $locale),
            'labelPositionedAbove' => $this->getLabelPositionedAbove(),
            'label' => $this->getLocalizedLabel($locale),
            'type' => $this->getType(),
            'name' => $this->getLocalizedName($locale),
            'value' => $this->getLocalizedValue($locale),
            'placeholder' => $this->getLocalizedPlaceholder($locale),
            'wire' => $this->getWire(),
            'prepend' => $this->getLocalizedPrepend($locale),
            'append' => $this->getLocalizedAppend($locale),
            'caption' => $this->getCaption(),
        ];
    }

    protected function getLocalizedContainerId(string $locale): ?string
    {
        return $this->getContainerId() ? $this->getContainerId() . '-' . $locale : null;
    }

    protected function getLocalizedComponentId(string $locale): string
    {
        return $this->getComponentId() . '-' . $locale;
    }

    protected function getLocalizedComponentHtmlAttributes(string $locale): array
    {
        return array_merge(['data-locale' => $locale], $this->getComponentHtmlAttributes());
    }

    protected function getLocalizedValidationClass(?ViewErrorBag $errors, string $locale): ?string
    {
        if (! $errors) {
            return null;
        }
        $errorBag = $this->getErrorMessageBag($errors);
        // Highlight field as invalid if it has errors.
        if ($errorBag->has($this->multilingualResolver->resolveErrorMessageBagKey($this->getName(), $locale))) {
            return $this->getDisplayFailure() ? 'is-invalid' : null;
        }
        // With standard page refreshing behaviour, only highlight field as valid when form has other errors.
        if (! $this->getWire() && $errorBag->isNotEmpty()) {
            return $this->getDisplaySuccess() ? 'is-valid' : null;
        }
        // With wired behaviour, only highlight field as valid if it has a value and has no error.
        if ($this->getWire() && $this->getValue()) {
            return $this->getDisplaySuccess() ? 'is-valid' : null;
        }

        return null;
    }

    protected function getLocalizedErrorMessage(?ViewErrorBag $errors, string $locale): ?string
    {
        if (! $errors) {
            return null;
        }
        if (! $this->getDisplayFailure()) {
            return null;
        }

        return $this->multilingualResolver->resolveErrorMessage(
            $this->getName(),
            $this->getErrorMessageBag($errors),
            $locale
        );
    }

    protected function getLocalizedLabel(string $locale): ?string
    {
        $label = $this->getLabel();

        return $label ? $label . ' (' . mb_strtoupper($locale) . ')' : null;
    }

    protected function getLocalizedName(string $locale): string
    {
        return $this->multilingualResolver->resolveLocalizedName($this->getName(), $locale);
    }

    protected function getLocalizedValue(string $locale)
    {
        $oldLocalizedValue = $this->multilingualResolver->resolveLocalizedOldValue($this->getName(), $locale);
        if ($oldLocalizedValue) {
            return $oldLocalizedValue;
        }
        if ($this->value instanceof Closure) {
            return ($this->value)($locale);
        }
        $localizedValue = $this->multilingualResolver->resolveLocalizedModelValue(
            $this->getName(),
            $locale,
            $this->getModel()
        );
        if ($localizedValue) {
            return $localizedValue;
        }

        return $this->getValue();
    }

    protected function getLocalizedPlaceholder(string $locale): ?string
    {
        $placeholder = $this->getPlaceholder();

        return $placeholder ? $placeholder . ' (' . mb_strtoupper($locale) . ')' : null;
    }

    protected function getLocalizedPrepend(string $locale): ?string
    {
        if ($this->prepend instanceof Closure) {
            return ($this->prepend)($locale);
        }

        return $this->getPrepend();
    }

    protected function getLocalizedAppend(string $locale): ?string
    {
        if ($this->append instanceof Closure) {
            return ($this->append)($locale);
        }

        return $this->getAppend();
    }
}
