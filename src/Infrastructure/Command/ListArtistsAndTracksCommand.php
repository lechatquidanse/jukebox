<?php

namespace App\Infrastructure\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Domain\ListArtistAndTrackInterface;

class ListArtistsAndTracksCommand extends Command
{
    public function __construct(readonly public ListArtistAndTrackInterface $list)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('list')
            ->setDescription('List all artists and tracks, with a number associated');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $results = ($this->list)();
        
        $output->writeln('List of all tracks:');
        $output->writeln(json_encode($results));
        

        return 0;
    }
}