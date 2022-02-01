<?php

declare(strict_types=1);

namespace Difra\Security\Filter;

/**
 * IP string validation
 */
class IP implements Common
{
    /**
     * @inheritdoc
     */
    public static function validate($string): bool
    {
        return filter_var($string, FILTER_VALIDATE_IP);
    }

    /**
     * @inheritdoc
     */
    public static function sanitize(string $string): ?string
    {
        return static::validate($string) ? $string : null;
    }
}