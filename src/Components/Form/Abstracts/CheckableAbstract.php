<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Illuminate\Support\ViewErrorBag;

abstract class CheckableAbstract extends InputAbstract
{
    protected bool $checked;

    public function checked(bool $checked = true): self
    {
        $this->checked = $checked;

        return $this;
    }

    protected function setLabelPositionedAbove(): bool
    {
        // Setting `true` but this property will not be used for checkable components.
        return true;
    }

    protected function getComponentHtmlAttributes(): array
    {
        return array_merge($this->componentHtmlAttributes, $this->getChecked() ? ['checked' => 'checked'] : []);
    }

    protected function getChecked(): bool
    {
        $oldChecked = old($this->convertArrayNameInNotation());
        if (isset($oldChecked)) {
            return $oldChecked;
        }
        if (isset($this->checked)) {
            return $this->checked;
        }
        if (isset($this->value)) {
            return (bool) $this->value;
        }

        return (bool) optional($this->model)->{$this->getName()};
    }
}
