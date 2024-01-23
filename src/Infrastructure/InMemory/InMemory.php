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
                new Artist(id: FilledString::fromString("id_artic_1"), name: FilledString::fromString("Arctic") ),
                new Artist(id: FilledString::fromString("id_u2_2"), name: FilledString::fromString("U2")),
            ],
            tracks: [
                new Track(
                    id: PositiveInt::fromInt(1), 
                    title: FilledString::fromString("are you mine"),
                    artistId: FilledString::fromString("id_artic_1")
                ),
                new Track(
                    id: PositiveInt::fromInt(2),
                    title: FilledString::fromString("bad"),
                    artistId: FilledString::fromString("id_2")
                ),
                new Track(
                    id: PositiveInt::fromInt(3), 
                    title: FilledString::fromString("view from the afternoon"),
                    artistId: FilledString::fromString("id_artic_1")
                ),
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

    public function getTrack(PositiveInt $number): Track|null
    {
        foreach ($this->tracks as $track) {
            if ($track->id == $number) {
                return $track;
            }
        }
        return null;
    }
}
