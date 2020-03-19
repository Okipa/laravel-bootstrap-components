<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Illuminate\Support\Str;
use Okipa\LaravelBootstrapComponents\Components\Form\Traits\RadioValidityChecks;

abstract class RadioAbstract extends CheckableAbstract
{
    use RadioValidityChecks;

    /** @inheritDoc */
    protected function getComponentId(): string
    {
        return $this->componentId
            ?? $this->getType() . '-' . Str::slug($this->getName()) . '-' . Str::slug($this->getValue());
    }

    /**
     * @return bool
     */
    protected function getChecked(): bool
    {
        $old = old($this->getName());
        if (isset($old) && $old !== '') {
            return $old === $this->value;
        }

        return $this->checked ?? optional($this->model)->{$this->getName()} === $this->value;
    }
}
