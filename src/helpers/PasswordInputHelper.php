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
     * Checks if a given string matches with a given pattern
     *
     * @param string $text
     * @param string $pattern
     * @return bool
     */
    public static function patternMatches(string $text, string $pattern): bool
    {
        return preg_match($pattern, $text) === 1;
    }
}
