<?php

namespace Okipa\LaravelBootstrapComponents\Facades;

use Illuminate\Support\Facades\Facade;

class Textarea extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'Textarea';
    }
}
