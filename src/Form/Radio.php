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
     * Set the default component id.
     *
     * @return string
     */
    protected function defaultComponentId(): string
    {
        return $this->type . '-' . Str::slug($this->name) . '-' . Str::slug($this->value);
    }

    /**
     * Set the input values.
     *
     * @return array
     * @throws \Exception
     */
    protected function values(): array
    {
        $parentValues = parent::values();
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
