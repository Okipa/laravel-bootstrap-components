<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Illuminate\Support\Str;
use Okipa\LaravelBootstrapComponents\Components\Form\Traits\RadioValidityChecks;

abstract class RadioAbstract extends CheckableAbstract
{
    use RadioValidityChecks;

    protected function getComponentId(): string
    {
        if ($this->componentId) {
            return $this->componentId;
        }

        return $this->getType() . '-' . Str::slug(Str::snake($this->convertArrayNameInNotation('-'), '-')
                . '-' . Str::snake($this->getValue(), '-'));
    }

    protected function getChecked(): bool
    {
        $old = old($this->getName());
        if (isset($old) && $old !== '') {
            return $old === (string) $this->value;
        }
        if (isset($this->checked)) {
            return $this->checked;
        }

        return optional($this->model)->{$this->getName()} === $this->value;
    }

    /** @return mixed */
    protected function getValue()
    {
        return $this->value;
    }
}
