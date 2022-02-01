<?php

declare(strict_types=1);

namespace Difra\Security\Filter;

/**
 * Class Datetime
 * @package Difra\Security\Filter
 */
class Datetime implements Common
{
    /** @var \Datetime[] */
    private static array $cache = [];

    /**
     * Validate input string
     * @param string $string
     * @return bool
     */
    public static function validate(string $string): bool
    {
        if (!isset(self::$cache[$string])) {
            self::$cache[$string] = self::parse($string) ?: false;
        }
        return (bool)self::$cache[$string];
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
        return self::$cache[$string]->format('Y-m-d H:i:s');
    }

    /**
     * @param string $string
     * @return \Datetime|null
     */
    private static function parse(string $string): ?\DateTime
    {
        try {
            return new \Datetime($string);
        } catch (\Exception) {
        }
        return null;
    }
}
