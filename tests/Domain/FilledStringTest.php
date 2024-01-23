<?php

declare(strict_types=1);

use App\Domain\FilledString;

use PHPUnit\Framework\TestCase;

class FilledStringTest extends TestCase
{
    public function testCannotCreateWithEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        FilledString::fromString('');
    }

    public function testCannotCreateWithSpaceString(): void
    {
        $this->expectException(InvalidArgumentException::class);

        FilledString::fromString('   ');
    }
}