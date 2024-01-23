<?php

declare(strict_types=1);

namespace App\Domain;

final class Artist
{
    public function __construct(
        readonly public FilledString $id,
        public FilledString $name,
    ) {
    }
}