<?php

declare(strict_types=1);

namespace Difra\Security\Filter;

/**
 * Float string sanitizing
 */
class Floats implements Common
{
    /**
     * @inheritdoc
     */
    public static function validate(string $string): bool
    {
        $string = str_replace(',', '.', $string);
        return false !== filter_var($string, FILTER_VALIDATE_FLOAT);
    }

    /**
     * @inheritdoc
     */
    public static function sanitize(string $string): ?float
    {
        $string = str_replace(',', '.', $string);
        return filter_var($string, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }
}