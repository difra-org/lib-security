<?php

declare(strict_types=1);

namespace Difra\Security\Filter;

/**
 * Integers sanitizing
 */
class Ints implements Common
{
    /**
     * @inheritdoc
     */
    public static function validate(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_INT) || $string === '0';
    }

    /**
     * @inheritdoc
     */
    public static function sanitize(string $string): int
    {
        return (int)filter_var($string, FILTER_SANITIZE_NUMBER_INT);
    }

}