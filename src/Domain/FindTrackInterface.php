<?php

declare(strict_types=1);

namespace App\Domain;

interface FindTrackInterface
{
    public function __invoke(int $number): ?Track;
}
