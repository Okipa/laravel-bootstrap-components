<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class InputNumber extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'InputNumber';
    }
}
