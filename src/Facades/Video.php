<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class Video extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Video';
    }
}
