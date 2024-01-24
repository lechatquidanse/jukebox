<?php

declare(strict_types=1);

namespace App\Domain;

final class Track
{
    public function __construct(
        readonly public int $id,
        readonly public string $artistId,
        public string $title,
    ) {
    }
}
