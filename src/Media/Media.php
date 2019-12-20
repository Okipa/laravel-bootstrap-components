<?php

namespace Okipa\LaravelBootstrapComponents\Media;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;

abstract class Media extends ComponentAbstract
{
    /**
     * The image src.
     *
     * @property string $src
     */
    protected $src;

    /**
     * Set the image src.
     *
     * @param string $src
     *
     * @return $this
     */
    public function src(string $src): self
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Set the image values.
     *
     * @return array
     */
    protected function getValues(): array
    {
        $src = $this->src;
        return array_merge(parent::getValues(), compact('src'));
    }

    /**
     * Check the component values validity
     */
    protected function checkValuesValidity(): void
    {
        //
    }
}
