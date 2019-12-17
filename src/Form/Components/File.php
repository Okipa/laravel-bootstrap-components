<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\File as AbstractFile;

class File extends AbstractFile
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
}
