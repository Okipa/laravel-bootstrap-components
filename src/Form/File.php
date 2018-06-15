<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Closure;

class File extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.file';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'file';
    /**
     * The uploaded file closure.
     *
     * @property \Closure $uploadedFile
     */
    protected $uploadedFile;
    /**
     * The show remove file checkbox status.
     *
     * @property \Closure $uploadedFile
     */
    protected $showRemoveCheckbox;

    /**
     * Set the uploaded file closure.
     *
     * @param \Closure $uploadedFile
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\File
     */
    public function uploadedFile(Closure $uploadedFile): File
    {
        $this->uploadedFile = $uploadedFile;

        return $this;
    }

    /**
     * Show the remove checkbox.
     *
     * @param bool $showed
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\File
     */
    public function showRemoveCheckbox(bool $showed = true): File
    {
        $this->showRemoveCheckbox = $showed;

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

        return array_merge($parentValues, [
            'placeholder'        => $parentValues['placeholder'] . ' : '
                                    . trans('bootstrap-components::bootstrap-components.label.file'),
            'uploadedFile'       => $this->uploadedFile,
            'showRemoveCheckbox' => isset($this->showRemoveCheckbox) ? $this->showRemoveCheckbox : $this->defaultRemoveCheckboxShowStatus(),
        ]);
    }

    /**
     * Set the file default checkbox show status
     *
     * @return string
     */
    protected function defaultRemoveCheckboxShowStatus(): string
    {
        $showRemoveCheckbox = config('bootstrap-components.' . $this->configKey . '.show_remove_checkbox');

        return $showRemoveCheckbox ? true : false;
    }
}
