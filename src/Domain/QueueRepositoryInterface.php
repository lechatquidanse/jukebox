<?php

declare(strict_types=1);

namespace App\Domain;

interface QueueRepositoryInterface
{
    public function find(): Queue;
    public function save(Queue $queue): void;
    public function clear(): void;
}
