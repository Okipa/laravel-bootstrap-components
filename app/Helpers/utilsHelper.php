<?php

if (! function_exists('validationStatus')) {
    function validationStatus($name)
    {
        if(session()->has('errors')){
            return session()->get('errors')->has($name) ? 'is-invalid' : 'is-valid';
        }
    }
}
