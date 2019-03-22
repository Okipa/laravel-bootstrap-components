<?php

if (! function_exists('validationStatus')) {
    function validationStatus($name, $showSuccess)
    {
        if (session()->has('errors')) {
            return session()->get('errors')->has($name) ? 'is-invalid' : ($showSuccess ? 'is-valid' : '');
        }
    }
}
