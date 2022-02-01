<?php

declare(strict_types=1);

namespace Difra\Security\Filter;

/**
 * Interface Common
 * @package Difra\Security\Filter
 */
interface Common
{
    /**
     * Validate input string
     * @param string $string
     * @return bool
     */
    public static function validate(string $string): bool;

    /**
     * Sanitize input string
     * @param string $string
     * @return mixed
     */
    public static function sanitize(string $string): mixed;
}
