<?php

declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use App\Domain\FindTrackInterface;
use App\Domain\Track;
use App\Infrastructure\InMemory\InMemory;

final class FindTrackInMemory implements FindTrackInterface
{
    public function __construct(private readonly InMemory $inMemory)
    {
    }

    public function __invoke(int $number): ?Track
    {
        return $this->inMemory->getTrack($number);
    }
}
