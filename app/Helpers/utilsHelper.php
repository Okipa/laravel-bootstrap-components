<?php

if (! function_exists('validationStatus')) {
    /**
     * @param string $name
     *
     * @return string|null
     */
    function validationStatus(string $name): ?string
    {
        return session()->has('errors') ? session()->get('errors')->has($name) ? 'is-invalid' : 'is-valid' : null;
    }
}
