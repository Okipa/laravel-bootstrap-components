<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class Button extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Button';
    }
}
