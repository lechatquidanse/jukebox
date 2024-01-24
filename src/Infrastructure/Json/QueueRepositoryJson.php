<?php

declare(strict_types=1);

namespace App\Infrastructure\Json;

use App\Domain\Queue;
use App\Domain\QueueRepositoryInterface;
use App\Domain\Track;

final class QueueRepositoryJson implements QueueRepositoryInterface
{
    private const FILE_PATH = './queue.json';

    public function find(): Queue
    {
        $this->ensureJsonExist();
        $json = file_get_contents(self::FILE_PATH);

        return $this->fromString($json);
    }

    public function save(Queue $queue): void
    {
        file_put_contents(self::FILE_PATH, $this->toJson($queue));
        return;
    }

    public function clear(): void
    {
        $this->save(Queue::empty());
    }

    private function ensureJsonExist(): void
    {
        if (!file_exists(self::FILE_PATH)) {
            $this->save(Queue::empty());
        }
    }


    private function toJson(Queue $queue): string
    {
        $json = [];

        foreach ($queue->tracks() as $track) {
            $json[] = [
                'id' => $track->id,
                'title' => $track->title,
                'artist_id' => $track->artistId,
            ];
        }

        return json_encode($json);
    }


    private function fromString(string $json): Queue
    {
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON data');
        }

        $tracks = $data ?? [];

        $queue = Queue::empty();

        foreach ($tracks as $track) {
            $queue->addTrack(
                new Track(
                    id: $track['id'],
                    title: $track['title'],
                    artistId: $track['artist_id'],
                )
            );
        }

        return $queue;
    }
}
