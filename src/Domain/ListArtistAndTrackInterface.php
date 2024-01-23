<?php

declare(strict_types=1);

namespace App\Domain;

interface ListArtistAndTrackInterface {
    public function __invoke(): array;
}