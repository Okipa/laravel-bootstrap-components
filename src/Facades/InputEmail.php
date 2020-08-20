<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class InputEmail extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'InputEmail';
    }
}
