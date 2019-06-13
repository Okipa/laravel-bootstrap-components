<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Illuminate\Support\Arr;

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
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function checked(bool $checked = true): Input
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
    protected function values(): array
    {
        $parentValues = parent::values();
        $oldValue = old($this->name);
        if (isset($oldValue)) {
            $this->checked = $oldValue;
        } elseif ($parentValues['value'] && ! isset($this->checked)) {
            $this->checked = true;
        }

//        dd(old('active'), $parentValues, $this->checked);
//        dd(Arr::except($parentValues, 'model'), $this->model->toArray(), $this->checked);

        return array_merge($parentValues, [
            'componentHtmlAttributes' => array_merge(
                $parentValues['componentHtmlAttributes'],
                $this->checked ? ['checked' => 'checked'] : []
            ),
        ]);
    }
}
