<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class Input extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'input';
    }
}
