<?php

namespace App\Infrastructure\Command;

use App\Domain\QueueRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearQueueCommand extends Command
{
    public function __construct(readonly public QueueRepositoryInterface $queueRepository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('clear')
            ->setDescription('Clear queue')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("Clear queue::");
        $this->queueRepository->clear();

        return 0;
    }
}
