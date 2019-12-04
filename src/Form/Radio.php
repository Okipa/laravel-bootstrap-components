<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Illuminate\Support\Str;
use Okipa\LaravelBootstrapComponents\Form\Traits\RadioValidityChecks;

class Radio extends Input
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
     * The input checked status.
     *
     * @property bool $checked
     */
    protected $checked;

    /**
     * Set the radio checked status.
     *
     * @param bool $checked
     *
     * @return $this
     */
    public function checked(bool $checked = true): self
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * @return string
     */
    protected function getComponentId(): string
    {
        return $this->componentId ?? $this->type . '-' . Str::slug($this->name) . '-' . Str::slug($this->value);
    }

    /**
     * Set the input values.
     *
     * @return array
     * @throws \Exception
     */
    protected function getValues(): array
    {
        $parentValues = parent::getValues();
        $oldValue = old($this->name);
        if (isset($oldValue)) {
            $this->checked = $this->value === $oldValue;
        } elseif ($this->model) {
            $this->checked = $this->model->{$this->name} === $this->value;
        }

        return array_merge($parentValues, [
            'componentHtmlAttributes' => array_merge(
                $parentValues['componentHtmlAttributes'],
                $this->checked ? ['checked' => 'checked'] : []
            ),
        ]);
    }
}
