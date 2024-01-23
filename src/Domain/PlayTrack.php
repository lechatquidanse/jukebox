<?php

declare(strict_types=1);

namespace App\Domain;

use InvalidArgumentException;

final class PlayTrack {
    public function __construct(
        public readonly FindTrackInterface $findTrack,
        public readonly QueueRepositoryInterface $queueRepository,
    ){}

    public function __invoke(PositiveInt... $numbers): void
    {
        $queue = $this->queueRepository->find();
        foreach ($numbers as $number) {
            $queue = $this->playTrack($number, $queue);
        }
        
        $this->queueRepository->save($queue);
    }

    private function playTrack(PositiveInt $number, Queue $queue): Queue
    {
        $track = ($this->findTrack)($number);   

        if (null === $track) {
            throw new InvalidArgumentException("Track with {$number->value} does not exist");
        }

        $queue->addTrack($track);

        return $queue;
    }
}