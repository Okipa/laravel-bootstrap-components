<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Form;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\Multilingual;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\Temporal;

class Input
{
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\Multilingual
     */
    public function text(): Multilingual
    {
        return app(config('bootstrap-components.form.components.text'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\Form
     */
    public function email(): Form
    {
        return app(config('bootstrap-components.form.components.email'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\Form
     */
    public function password(): Form
    {
        return app(config('bootstrap-components.form.components.password'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\Form
     */
    public function url(): Form
    {
        return app(config('bootstrap-components.form.components.url'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\Form
     */
    public function tel(): Form
    {
        return app(config('bootstrap-components.form.components.tel'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\Form
     */
    public function number(): Form
    {
        return app(config('bootstrap-components.form.components.number'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\Form
     */
    public function color(): Form
    {
        return app(config('bootstrap-components.form.components.color'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\Temporal
     */
    public function date(): Temporal
    {
        return app(config('bootstrap-components.form.components.date'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\Temporal
     */
    public function time(): Temporal
    {
        return app(config('bootstrap-components.form.components.time'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\Temporal
     */
    public function datetime(): Temporal
    {
        return app(config('bootstrap-components.form.components.datetime'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\File
     */
    public function file(): \Okipa\LaravelBootstrapComponents\Form\Abstracts\File
    {
        return app(config('bootstrap-components.form.components.file'));
    }
}
