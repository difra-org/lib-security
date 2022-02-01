<?php

declare(strict_types=1);

namespace Difra\Security\Filter;

/**
 * Class Email
 * @package Difra\Security\Filter
 */
class Email implements Common
{
    /**
     * @inheritdoc
     */
    public static function validate(string $string): bool
    {
        return
            !preg_match('([.@]{2,})', $string)
            &&
            preg_match('/^[a-zA-Z0-9_-]([a-zA-Z0-9._-]*)+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,10})$/', $string)
            &&
            (filter_var($string, FILTER_SANITIZE_EMAIL) !== false)
            &&
            strlen($string) < 255;
    }

    /**
     * @inheritdoc
     */
    public static function sanitize(string $string): ?string
    {
        if (!self::validate($string)) {
            return null;
        }
        return filter_var($string, FILTER_SANITIZE_EMAIL) ?: null;
    }
}
