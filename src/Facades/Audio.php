<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class Audio extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Audio';
    }
}
