<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

abstract class CheckableAbstract extends FormAbstract
{
    /** @property bool $checked */
    protected $checked;

    public function checked(bool $checked = true): self
    {
        $this->checked = $checked;

        return $this;
    }

    protected function setLabelPositionedAbove(): bool
    {
        return true; // unused
    }

    protected function getComponentHtmlAttributes(): array
    {
        return array_merge(parent::getComponentHtmlAttributes(), $this->getChecked() ? ['checked' => 'checked'] : []);
    }

    protected function getChecked(): bool
    {
        $old = old($this->convertArrayNameInNotation());
        if (isset($old)) {
            return $old;
        }

        return $this->checked ?? boolval(optional($this->model)->{$this->getName()} ?: $this->value);
    }
}
