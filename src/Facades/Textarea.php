<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class Textarea extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Textarea';
    }
}
