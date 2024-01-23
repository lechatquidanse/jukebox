<?php

declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use App\Domain\FindPlayingTrackInterface;
use App\Infrastructure\InMemory\InMemory;


final class FindPlayingTrackInMemory implements FindPlayingTrackInterface
{
    public function __construct(private readonly InMemory $inMemory)
    {
    }

    public function __invoke(): String
    {
        $queue = $this->inMemory->getQueue();

        if (empty($queue->tracks())) {
            throw new \RuntimeException("No playing track");
        } 

        $track = current($queue->tracks());

        return "Playing {$track->id->value} - {$track->name->value}";
    }
}