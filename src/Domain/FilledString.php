<?php

declare(strict_types=1);

namespace App\Domain;

use InvalidArgumentException;

final class FilledString
{
    private function __construct(
        readonly public string $value
    ) {
    }

    public static function fromString(string $value): FilledString
    {
        self::ensureIsStringFilled($value);

        return new self($value);
    }

    private static function ensureIsStringFilled(string $value): void
    {
        if (empty(trim($value))) {
            throw new InvalidArgumentException("Expect filled string value, got '$value'");
        }
    }
}
