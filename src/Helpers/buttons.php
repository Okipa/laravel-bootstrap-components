<?php

use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract;
use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract;
use Okipa\LaravelBootstrapComponents\Components\Component;

if (! function_exists('submit')) {
    function submit(): SubmitAbstract
    {
        return (new Component)->submit();
    }
}

if (! function_exists('submitCreate')) {
    function submitCreate(): SubmitAbstract
    {
        return (new Component)->submitCreate();
    }
}

if (! function_exists('submitUpdate')) {
    function submitUpdate(): SubmitAbstract
    {
        return (new Component)->submitUpdate();
    }
}

if (! function_exists('submitValidate')) {
    function submitValidate(): SubmitAbstract
    {
        return (new Component)->submitValidate();
    }
}

if (! function_exists('button')) {
    function button(): ButtonAbstract
    {
        return (new Component)->button();
    }
}

if (! function_exists('buttonLink')) {
    function buttonLink(): ButtonAbstract
    {
        return (new Component)->buttonLink();
    }
}

if (! function_exists('buttonBack')) {
    function buttonBack(): ButtonAbstract
    {
        return (new Component)->buttonBack();
    }
}

if (! function_exists('buttonCancel')) {
    function buttonCancel(): ButtonAbstract
    {
        return (new Component)->buttonCancel();
    }
}
