<?php

declare(strict_types=1);

namespace Difra\Security\Filter;

class Bankcard implements Common
{
    /**
     * Validate input string
     * @param string $string
     * @return bool
     */
    public static function validate(string $string): bool
    {
        return (bool)\Difra\Security\Parser\Bankcard::getType($string);
    }

    /**
     * Sanitize input string
     * @param string $string
     * @return string|null
     */
    public static function sanitize(string $string): ?string
    {
        return self::validate($string) ? str_replace([' ', '-'], '', $string) : null;
    }
}
