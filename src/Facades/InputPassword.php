<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class InputPassword extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'InputPassword';
    }
}
