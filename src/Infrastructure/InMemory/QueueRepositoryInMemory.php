<?php

declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use App\Domain\Queue;
use App\Domain\QueueRepositoryInterface;


final class QueueRepositoryInMemory implements QueueRepositoryInterface
{
    public function __construct(private readonly InMemory $inMemory)
    {
    }

    public function find(): Queue
    {
        return $this->inMemory->getQueue();
    }

    public function save(Queue $queue): void
    {
        $this->inMemory->setQueue($queue);
    }

    public function isEmpty(): bool
    {
        return empty($this->find()->tracks());
    }
}