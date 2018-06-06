<?php

if (! function_exists('renderHtmlClass')) {
    function renderHtmlClass(array $classArray = [])
    {
        return implode(' ', $classArray);
    }
}

if (! function_exists('renderHtmlDataAttributes')) {
    function renderHtmlAttributes(array $attributes = [])
    {
        $html = '';
        foreach ($attributes as $key => $attribute) {
            if ($key && ! is_numeric($key)) {
                $html .= $key . ($attribute ? '="' . $attribute . '"' : '');
            } else {
                $html .= strlen($html) ? ' ' . $attribute : $attribute;
            }
        }

        return $html;
    }
}