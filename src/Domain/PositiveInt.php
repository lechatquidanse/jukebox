<?php

declare(strict_types=1);

namespace App\Domain;

use InvalidArgumentException;

final class PositiveInt
{
    private function __construct(
        readonly public int $value
    ) {
    }

    public static function fromInt(int $value): PositiveInt
    {
        self::ensureIsIntPositive($value);

        return new self($value);
    }

    private static function ensureIsIntPositive(int $value): void
    {
        if ($value <= 0) {
            throw new InvalidArgumentException("Expect int > 0, got '$value'");
        }
    }
}