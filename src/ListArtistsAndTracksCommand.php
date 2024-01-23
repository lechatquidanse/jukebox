<?php

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListArtistsAndTracksCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('list')
            ->setDescription('List all artists and tracks, with a number associated');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('List of all tracks');
        return 0;
    }
}