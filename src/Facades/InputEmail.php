<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class InputEmail extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'InputEmail';
    }
}
