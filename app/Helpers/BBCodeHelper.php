<?php

namespace App\Helpers;

class BBCodeHelper
{
    public static function stripBBCode($text)
    {
        // Regular expression to match BBCode tags
        $bbcodeRegex = '/\[(\/?[a-zA-Z0-9=#,;.]+)(?:[^\]]*)\]/';

        // Replace all BBCode tags with an empty string
        return preg_replace($bbcodeRegex, '', $text);
    }
}
