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
     * Set the input values.
     *
     * @return array
     * @throws \Exception
     */
    protected function values(): array
    {
        $parentValues = parent::values();

        return array_merge($parentValues, [
            'placeholder'  => $parentValues['placeholder'] . ' : '
                              . trans('bootstrap-components::bootstrap-components.label.file'),
            'uploadedFile' => $this->uploadedFile,
        ]);
    }
}
