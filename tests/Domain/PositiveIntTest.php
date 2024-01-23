<?php

declare(strict_types=1);

use App\Domain\PositiveInt;

use PHPUnit\Framework\TestCase;

class PositiveIntTest extends TestCase
{
    public function testCannotCreateNegative(): void
    {
        $this->expectException(InvalidArgumentException::class);

        PositiveInt::fromInt(-1);
    }

    public function testCannotCreateWithZero(): void
    {
        $this->expectException(InvalidArgumentException::class);

        PositiveInt::fromInt(0);
    }
}