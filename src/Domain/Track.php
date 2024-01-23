<?php

declare(strict_types=1);

namespace App\Domain;

final class Track
{
    public function __construct(
        readonly public PositiveInt $id,
        readonly public FilledString $artistId,
        public FilledString $title,
        
    ) {
    }
}