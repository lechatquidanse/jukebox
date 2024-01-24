<?php

declare(strict_types=1);

use App\Domain\Queue;
use App\Domain\Track;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class QueueTest extends TestCase
{
    public function testCanAddTrackWithNewArtist(): void
    {
        $track1Gorillaz = $this->givenTrack(1, "gorillaz");
        $track1U2 = $this->givenTrack(2, "U2");

        $queue = Queue::empty();

        $queue->addTrack($track1U2);
        $queue->addTrack($track1Gorillaz);

        assertEquals(
            $queue->tracks(),
            [
                $track1U2,
                $track1Gorillaz,
            ]
        );
    }

    public function testCanAddTrackAfterTracksWithSameArtist(): void
    {
        $track1Gorillaz = $this->givenTrack(1, "gorillaz");
        $track1U2 = $this->givenTrack(2, "U2");
        $track2U2 = $this->givenTrack(3, "U2");

        $queue = Queue::empty();

        $queue->addTrack($track1U2);
        $queue->addTrack($track1Gorillaz);
        $queue->addTrack($track2U2);

        assertEquals(
            $queue->tracks(),
            [
                $track1U2,
                $track2U2,
                $track1Gorillaz,
            ]
        );
    }

    private function givenTrack(int $number, string $artistId): Track
    {
        return new Track(id: $number, title: "some generic title", artistId: $artistId, );
    }
}