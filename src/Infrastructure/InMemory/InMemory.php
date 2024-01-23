<?php

declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use App\Domain\Artist;
use App\Domain\FilledString;
use App\Domain\PositiveInt;
use App\Domain\Track;

final class InMemory
{
    private function __construct(private array $artists, private array $tracks)
    {
    }

    public static function empty(): InMemory
    {
        return new self([], []);
    }
    public static function filled(): InMemory
    {
        return new self(
            artists: [
                new Artist(id: FilledString::fromString("id_1"), name: FilledString::fromString("Arctic") ),
                new Artist(id: FilledString::fromString("id_2"), name: FilledString::fromString("U2")),
            ],
            tracks: [

                new Track(id: PositiveInt::fromInt(1), title: FilledString::fromString("follow") ),
                new Track(id: PositiveInt::fromInt(3), title: FilledString::fromString("the river")),
            ]
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
}
