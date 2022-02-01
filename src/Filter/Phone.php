<?php

declare(strict_types=1);

namespace Difra\Security\Filter;

/**
 * Class Phone
 * @package Difra\Security\Filter
 */
class Phone implements Common
{
    /**
     * Validate input string
     * @param string $string
     * @return bool
     */
    public static function validate(string $string): bool
    {
        $ph = str_replace(['+', '(', ')', '-', ' '], '', $string);
        return ctype_digit($ph) and mb_strlen($ph) >= 8 and mb_strlen($ph) <= 12;
    }

    /**
     * Sanitize input string
     * @param string $string
     * @return string|null
     */
    public static function sanitize(string $string): ?string
    {
        if (!self::validate($string)) {
            return null;
        }
        return str_replace(['+', '(', ')', '-', ' '], '', $string);
    }
}
