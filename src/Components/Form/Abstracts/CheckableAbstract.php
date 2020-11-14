<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

abstract class CheckableAbstract extends FormAbstract
{
    protected bool $checked;

    public function checked(bool $checked = true): self
    {
        $this->checked = $checked;

        return $this;
    }

    protected function setLabelPositionedAbove(): bool
    {
        return true; // Unused for checkable components.
    }

    protected function getComponentHtmlAttributes(): array
    {
        return array_merge(parent::getComponentHtmlAttributes(), $this->getChecked() ? ['checked' => 'checked'] : []);
    }

    protected function getChecked(): bool
    {
        $old = old($this->convertArrayNameInNotation());

        return $old ?? $this->checked ?? (bool) (optional($this->model)->{$this->getName()} ?: $this->value);
    }
}
