<?php

declare(strict_types=1);

namespace App\Domain;

use InvalidArgumentException;

final class PlayTrack
{
    public function __construct(
        public readonly FindTrackInterface $findTrack,
        public readonly QueueRepositoryInterface $queueRepository,
    ) {
    }

    public function __invoke(int... $numbers): void
    {
        $queue = $this->queueRepository->find();
        foreach ($numbers as $number) {
            $this->playTrack($number, $queue);
        }

        $this->queueRepository->save($queue);
    }

    private function playTrack(int $number, Queue $queue): Queue
    {
        $track = ($this->findTrack)($number);

        if (null === $track) {
            throw new InvalidArgumentException("Track with {$number} does not exist");
        }

        $queue->addTrack($track);

        return $queue;
    }
}
