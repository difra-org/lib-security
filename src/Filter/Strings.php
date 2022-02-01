<?php

declare(strict_types=1);

namespace Difra\Security\Filter;

/**
 * Strings sanitizing
 */
class Strings implements Common
{
    /**
     * @inheritdoc
     */
    public static function validate(string $string): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function sanitize(string $string): ?string
    {
        return $string;
    }
}