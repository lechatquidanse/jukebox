<?php

declare(strict_types=1);

use App\Domain\FilledString;
use App\Domain\PositiveInt;
use App\Infrastructure\InMemory\InMemory;
use App\Infrastructure\InMemory\ListArtistAndTracksInMemory;
use App\Domain\Artist;
use App\Domain\Track;

use PHPUnit\Framework\TestCase;

class ListArtistAndTracksInMemoryTest extends TestCase
{
    public function testCanList(): void
    {
        $inMemory = InMemory::empty();
        $inMemory->addArtist($this->givenArtist("id_1", "Arctic"));
        $inMemory->addArtist($this->givenArtist("id_2", "U2"));
        $inMemory->addTrack($this->givenTrack(1, "follow"));
        $inMemory->addTrack($this->givenTrack(2, "the river"));

        $list = new ListArtistAndTracksInMemory($inMemory);

        $this->assertEquals(
            $list(),
            [
                'artists' => [
                    [
                        'id' => 'id_1',
                        'name' => 'Arctic',
                    ],
                    [
                        'id' => 'id_2',
                        'name' => 'U2',
                    ],
                ],
                'tracks' => [
                    [

                        'id' => 1,
                        'title' => 'follow',
                        'artist_id' => 'some_artist_id',
                    ],
                    [

                        'id' => 2,
                        'title' => 'the river',
                        'artist_id' => 'some_artist_id',
                    ],
                ],
            ]
        );
    }

    private function givenArtist(string $id, string $name): Artist
    {
        return new Artist(
            id: FilledString::fromString($id),
            name: FilledString::fromString($name)

        );
    }

    private function givenTrack(int $number, string $title): Track
    {
        return new Track(id: $number, title: $title, artistId: "some_artist_id");
    }
}