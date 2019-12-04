<?php

namespace Okipa\LaravelBootstrapComponents\Form;

abstract class Checkable extends Input
{
    /**
     * The input checked status.
     *
     * @property bool $checked
     */
    protected $checked;

    /**
     * Set the checkable component check status.
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
            $this->checked = $oldValue;
        } elseif ($parentValues['value'] && ! isset($this->checked)) {
            $this->checked = true;
        }
        $componentHtmlAttributes = array_merge(
            $parentValues['componentHtmlAttributes'],
            $this->checked ? ['checked' => 'checked'] : []
        );

        return array_merge($parentValues, compact('componentHtmlAttributes'));
    }
}
