<?php

namespace Okipa\LaravelBootstrapComponents\Components\Traits;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract;
use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract;

trait ButtonComponentsTrait
{
    public function submit(): SubmitAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract $submit */
        $submit = app(config('bootstrap-components.components.submit'));

        return $submit;
    }

    public function submitCreate(): SubmitAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract $submitCreate */
        $submitCreate = app(config('bootstrap-components.components.create'));

        return $submitCreate;
    }

    public function submitUpdate(): SubmitAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract $submitUpdate */
        $submitUpdate = app(config('bootstrap-components.components.update'));

        return $submitUpdate;
    }

    public function submitValidate(): SubmitAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract $submitValidate */
        $submitValidate = app(config('bootstrap-components.components.validate'));

        return $submitValidate;
    }

    public function button(): ButtonAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract $button */
        $button = app(config('bootstrap-components.components.button'));

        return $button;
    }

    public function buttonLink(): ButtonAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract $buttonLink */
        $buttonLink = app(config('bootstrap-components.components.link'));

        return $buttonLink;
    }

    public function buttonBack(): ButtonAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract $buttonBack */
        $buttonBack = app(config('bootstrap-components.components.back'));

        return $buttonBack;
    }

    public function buttonCancel(): ButtonAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract $buttonCancel */
        $buttonCancel = app(config('bootstrap-components.components.cancel'));

        return $buttonCancel;
    }
}
