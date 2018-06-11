<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class InputToggle extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'input_toggle';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'toggle';
    /**
     * The toggle check status.
     *
     * @property string $checked
     */
    protected $checked;

    /**
     * Set the input Value.
     *
     * @param bool $status
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\InputToggle
     */
    public function checked(bool $status): InputToggle
    {
        $this->checked = $status;

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
        return array_merge(parent::values(), [
            'type'    => 'toggle',
            'model'   => $this->model,
            'name'    => $this->name,
            'label'   => $this->showLabel === false
                ? (
                $this->label
                    ? $this->label
                    : trans('bootstrap-components::bootstrap-components.validation.attributes.' . $this->name)
                )
                : '',
            'checked' => isset($this->checked)
                ? $this->checked
                : $this->model ? boolval($this->model->{$this->name}) : false,
        ]);
    }
}
