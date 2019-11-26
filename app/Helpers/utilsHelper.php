<?php

// todo : remove this unused helper on next major release.
if (! function_exists('validationStatus')) {
    /**
     * @param string $name
     *
     * @return string|null
     * @deprecated this helper will be removed in the next major release.
     */
    function validationStatus(string $name): ?string
    {
        return session()->has('errors') ? session()->get('errors')->has($name) ? 'is-invalid' : 'is-valid' : null;
    }
}
