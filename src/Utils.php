<?php

namespace LeDevoir\PianoIdApiSDK;

class Utils
{
    /**
     * @param string $input
     * @return string
     */
    public static function snakeToCamelCase(string $input): string
    {
        return lcfirst(
            str_replace(' ', '',
                ucwords(str_replace('_', ' ', $input)
                )
            )
        );
    }
}