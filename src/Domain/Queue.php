<?php

declare(strict_types=1);

namespace App\Domain;

final class Queue
{
    private function __construct(
        private array $tracks = []
    ) {
    }

    public static function empty(): self
    {
        return new self();
    }

    public function addTrack(Track $track): void
    {
        $lastTrackPositionWithArtist = $this->findLastTrackPositionWithArtist($track->artistId);
        $this->insertTrackIn($lastTrackPositionWithArtist, $track);
    }

    public function tracks(): array
    {
        return $this->tracks;
    }

    private function insertTrackIn(int $index, Track $track): void
    {
        if ($index == -1) {
            $this->tracks[] = $track;
            return;
        }

        $this->tracks = array_merge(
            array_slice($this->tracks, 0, $index + 1),
            [$track],
            array_slice($this->tracks, $index + 1),
        );
    }

    private function findLastTrackPositionWithArtist(string $artistId): int
    {
        $lastIndex = -1;

        foreach ($this->tracks as $index => $track) {
            if ($track->artistId === $artistId) {
                $lastIndex = $index;
            }
        }

        return $lastIndex;
    }
}
