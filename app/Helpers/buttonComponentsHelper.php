<?php

use Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract;
use Okipa\LaravelBootstrapComponents\Buttons\Abstracts\SubmitAbstract;
use Okipa\LaravelBootstrapComponents\Component;

if (! function_exists('submit')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    function submit(): SubmitAbstract
    {
        return (new Component)->submit();
    }
}

if (! function_exists('submitCreate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    function submitCreate(): SubmitAbstract
    {
        return (new Component)->submitCreate();
    }
}

if (! function_exists('submitUpdate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    function submitUpdate(): SubmitAbstract
    {
        return (new Component)->submitUpdate();
    }
}

if (! function_exists('submitValidate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    function submitValidate(): SubmitAbstract
    {
        return (new Component)->submitValidate();
    }
}

if (! function_exists('button')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    function button(): ButtonAbstract
    {
        return (new Component)->button();
    }
}

if (! function_exists('buttonLink')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    function buttonLink(): ButtonAbstract
    {
        return (new Component)->buttonLink();
    }
}

if (! function_exists('buttonBack')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    function buttonBack(): ButtonAbstract
    {
        return (new Component)->buttonBack();
    }
}

if (! function_exists('buttonCancel')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    function buttonCancel(): ButtonAbstract
    {
        return (new Component)->buttonCancel();
    }
}
