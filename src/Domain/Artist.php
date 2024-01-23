<?php

declare(strict_types=1);

namespace App\Domain;

final class Artist
{
    public function __construct(
        readonly private FilledString $id,
        private FilledString $name,
    ) {
    }
}