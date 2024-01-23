<?php

declare(strict_types=1);

namespace App\Domain;

interface FindPlayingTrackInterface {
    public function __invoke(): String;
}