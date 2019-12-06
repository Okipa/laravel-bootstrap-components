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
     * @return array
     */
    protected function getComponentHtmlAttributes(): array
    {
        return array_merge(parent::getComponentHtmlAttributes(), $this->getChecked() ? ['checked' => 'checked'] : []);
    }

    /**
     * @return bool
     */
    protected function getChecked(): bool
    {
        $old = old($this->getName());
        if (isset($old)) {
            return $old;
        }

        return $this->checked ?? boolval(optional($this->model)->{$this->getName()} ?: $this->value);
    }
}
