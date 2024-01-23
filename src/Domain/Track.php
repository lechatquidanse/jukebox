<?php

declare(strict_types=1);

namespace App\Domain;

final class Track
{
    public function __construct(
        readonly private PositiveInt $id,
        private FilledString $title,
    ) {
    }
}