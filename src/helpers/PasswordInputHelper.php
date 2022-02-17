<?php

namespace eluhr\passwordInput\helpers;

/**
 * --- PROPERTIES ---
 *
 * @author Elias Luhr
 */
class PasswordInputHelper
{
    /**
     * Matches cache
     *
     * @var array
     */
    protected static $_matches = [];

    /**
     * Checks if a given string matches with a given pattern and caches it in a static variable
     *
     * @param string|null $text
     * @param string $pattern
     * @return bool
     */
    public static function patternMatches($text, string $pattern): bool
    {
        $index = md5($pattern . $text);
        if (!isset(self::$_matches[$index])) {
            self::$_matches[$index] = preg_match($pattern, $text) === 1;
        }
        return self::$_matches[$index];
    }
}
