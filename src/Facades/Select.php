<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class Select extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Select';
    }
}
