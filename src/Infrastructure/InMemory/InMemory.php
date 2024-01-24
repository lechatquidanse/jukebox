<?php

declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use App\Domain\Artist;
use App\Domain\FilledString;
use App\Domain\Queue;
use App\Domain\Track;

final class InMemory
{
    private function __construct(
        private array $artists,
        private array $tracks,
        private Queue $queue,
    ) {
    }

    public static function empty(): InMemory
    {
        return new self([], [], Queue::empty());
    }
    public static function filled(): InMemory
    {
        return new self(
            artists: [
                new Artist(id: FilledString::fromString("id_artic_1"), name: FilledString::fromString("Arctic")),
                new Artist(id: FilledString::fromString("id_u2_2"), name: FilledString::fromString("U2")),
            ],
            tracks: [
                new Track(id: 1, title: "are you mine", artistId: "id_artic_1"),
                new Track(id: 2, title: "bad", artistId: "id_2"),
                new Track(id: 3, title: "view from the afternoon", artistId: "id_artic_1"),
            ],
            queue: Queue::empty(),
        );
    }

    public function addTrack(Track $track): void
    {
        $this->tracks[] = $track;
    }


    public function addArtist(Artist $artist): void
    {
        $this->artists[] = $artist;
    }

    public function getTracks(): array
    {
        return $this->tracks;
    }
    public function getArtists(): array
    {
        return $this->artists;
    }
    public function getQueue(): Queue
    {
        return $this->queue;
    }
    public function setQueue(Queue $queue): void
    {
        $this->queue = $queue;
    }

    public function getTrack(int $number): Track|null
    {
        foreach ($this->tracks as $track) {
            if ($track->id == $number) {
                return $track;
            }
        }
        return null;
    }
}
