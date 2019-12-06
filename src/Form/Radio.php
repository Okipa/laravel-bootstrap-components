<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Illuminate\Support\Str;
use Okipa\LaravelBootstrapComponents\Form\Traits\RadioValidityChecks;

class Radio extends Checkable
{
    use RadioValidityChecks;

    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.radio';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'radio';

    /**
     * @return string
     */
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
        if ($old) {
            return $old === $this->value;
        }

        return $this->checked ?? optional($this->model)->{$this->getName()} === $this->value;
    }
}
