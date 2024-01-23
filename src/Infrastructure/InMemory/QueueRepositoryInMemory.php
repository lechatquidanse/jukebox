<?php

declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use App\Domain\Queue;
use App\Domain\QueueRepositoryInterface;


final class QueueRepositoryInMemory implements QueueRepositoryInterface
{
    private Queue $queue;

    public function __construct(
    ) {
        $this->queue = Queue::empty();
    }

    public function find(): Queue
    {
        return $this->queue;
    }

    public function save(Queue $queue): void
    {
        $this->queue = $queue;
    }

    public function isEmpty(): bool
    {
        return empty($this->queue->tracks());
    }
}