<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class InputFile extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'InputFile';
    }
}
