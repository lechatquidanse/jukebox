<?php

declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use App\Domain\ListArtistAndTrackInterface;
use App\Domain\Track;
use App\Domain\Artist;
use App\Infrastructure\InMemory\InMemory;


final class ListArtistAndTracksInMemory implements ListArtistAndTrackInterface
{
    public function __construct(private readonly InMemory $inMemory)
    {
    }

    public function __invoke(): array
    {
        return [
            'artists' => array_map(
                fn (Artist $artist): array => self::formatArtist($artist),
                $this->inMemory->getArtists()
            ),
            'tracks' => array_map(
                fn (Track $track): array => self::formatTrack($track),
                $this->inMemory->getTracks()
            ),
        ];
    }

    private static function formatTrack(Track $track): array {
        return [
            "id"=> $track->id->value,
            "title"=> $track->title->value,
        ];
    }

    private static function formatArtist(Artist $artist): array {
        return [
            "id"=> $artist->id->value,
            "name"=> $artist->name->value,
        ];
    }
}