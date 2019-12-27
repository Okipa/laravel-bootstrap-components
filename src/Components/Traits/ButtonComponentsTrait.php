<?php

namespace Okipa\LaravelBootstrapComponents\Components\Traits;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract;
use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract;

trait ButtonComponentsTrait
{
    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract
     */
    public function submit(): SubmitAbstract
    {
        return app(config('bootstrap-components.components.submit'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract
     */
    public function submitCreate(): SubmitAbstract
    {
        return app(config('bootstrap-components.components.create'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract
     */
    public function submitUpdate(): SubmitAbstract
    {
        return app(config('bootstrap-components.components.update'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract
     */
    public function submitValidate(): SubmitAbstract
    {
        return app(config('bootstrap-components.components.validate'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract
     */
    public function button(): ButtonAbstract
    {
        return app(config('bootstrap-components.components.button'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract
     */
    public function buttonLink(): ButtonAbstract
    {
        return app(config('bootstrap-components.components.link'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract
     */
    public function buttonBack(): ButtonAbstract
    {
        return app(config('bootstrap-components.components.back'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract
     */
    public function buttonCancel(): ButtonAbstract
    {
        return app(config('bootstrap-components.components.cancel'));
    }
}
