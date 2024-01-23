<?php

namespace App\Infrastructure\Command;

use App\Domain\QueueRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FindQueueCommand extends Command
{
    public function __construct(readonly public QueueRepositoryInterface $queueRepository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('queue')
            ->setDescription('list contents of the queue including currently playing track')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queue = $this->queueRepository->find();

        $output->writeln("In Queue::");

        foreach ($queue->tracks() as $key => $track) {
            if ($key == 0) {
                $output->writeln("Playing track ${$track->title->value}");
            } else {
                $output->writeln("Queuing track ${$track->title->value}");
            }
        }

        return 0;
    }
}