<?php

namespace App\Helpers;

class GenerateSlug
{
    function generateSlug($string)
    {
        $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $string));
        return trim($slug, '-');
    }
}
