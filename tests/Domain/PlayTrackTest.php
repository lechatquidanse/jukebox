<?php

declare(strict_types=1);


use App\Domain\PlayTrack;
use App\Domain\Track;
use App\Infrastructure\InMemory\FindTrackInMemory;
use App\Infrastructure\InMemory\InMemory;
use App\Infrastructure\InMemory\QueueRepositoryInMemory;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class PlayTrackTest extends TestCase
{
    public function testCanPlayMultipleTrack(): void
    {
        $trackId = 99;
        $track = new Track(id: $trackId, title: "99 problems", artistId: "jay-z");

        $inMemory = InMemory::filled();
        $inMemory->addTrack($track);

        $queueRepository = new QueueRepositoryInMemory($inMemory);

        $playTrack = new PlayTrack(
            findTrack: new FindTrackInMemory($inMemory),
            queueRepository: $queueRepository
        );

        assertEquals($queueRepository->isEmpty(), true);
        $playTrack($trackId);
        assertEquals($queueRepository->isEmpty(), false);
    }

    public function testCanNotPlayThatDoesNotExist(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $inMemory = InMemory::empty();

        $playTrack = new PlayTrack(
            findTrack: new FindTrackInMemory($inMemory),
            queueRepository: new QueueRepositoryInMemory($inMemory)
        );
        $playTrack(99);
    }
}