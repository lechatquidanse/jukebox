<?php

namespace App\Infrastructure\Command;

use App\Domain\PlayTrack;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PlayTrackCommand extends Command
{
    public function __construct(readonly public PlayTrack $playTrack)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('play')
            ->setDescription('Play a track by its number')
            ->addArgument('numbers', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'track numbers');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $numbers = $input->getArgument('numbers');

        ($this->playTrack)(...$numbers);

        return 0;
    }
}
