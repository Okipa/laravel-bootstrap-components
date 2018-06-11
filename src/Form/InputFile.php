<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Closure;

class InputFile extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'input_file';
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
     * Set the input type.
     *
     * @param \Closure $uploadedFile
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\InputFile
     */
    public function uploadedFile(Closure $uploadedFile): InputFile
    {
        $this->uploadedFile = $uploadedFile;

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
            'type'         => 'file',
            'placeholder'  => $parentValues['placeholder'] . ' : '
                              . trans('bootstrap-components::bootstrap-components.label.file'),
            'uploadedFile' => $this->uploadedFile,
        ]);
    }
}
