<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Illuminate\Support\Str;
use Okipa\LaravelBootstrapComponents\Components\Form\Traits\RadioValidityChecks;

abstract class RadioAbstract extends CheckableAbstract
{
    use RadioValidityChecks;

    protected function getComponentId(): string
    {
        return $this->componentId
            ?? $this->getType() . '-' . Str::slug(Str::snake($this->convertArrayNameInNotation('-'), '-')
                . '-' . Str::snake($this->getValue(), '-'));
    }

    protected function getChecked(): bool
    {
        $old = old($this->getName());
        if (isset($old) && $old !== '') {
            return $old === (string) $this->value;
        }

        return $this->checked ?? optional($this->model)->{$this->getName()} === $this->value;
    }
}
