<?php

declare(strict_types=1);

namespace Difra\Security\Filter;

/**
 * URL sanitizing
 */
class URL implements Common
{
    /**
     * @inheritdoc
     */
    public static function validate(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_URL);
    }

    /**
     * @inheritdoc
     */
    public static function sanitize(string $string): ?string
    {
        return filter_var($string, FILTER_SANITIZE_URL);
    }
}