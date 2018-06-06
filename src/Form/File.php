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
    protected $configKey = 'file';
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
     * @return \App\Components\Form\File
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
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'uploadedFile' => $this->uploadedFile,
        ]);
    }
}
