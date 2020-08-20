<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class InputNumber extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'InputNumber';
    }
}
