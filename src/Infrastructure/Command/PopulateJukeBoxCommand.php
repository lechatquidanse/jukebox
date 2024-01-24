<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PopulateJukeboxCommand extends Command
{
    public function __construct(readonly public EntityManagerInterface $manager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('populate-jukebox')
            ->setDescription('Populate jukebox library');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("Populate jukebox with 3 artists and 4 tracks");

        try {
            $artistSql = "
            INSERT INTO artists (id, name) VALUES
            ('1', 'Artist 1'),
            ('2', 'Artist 2'),
            ('3', 'Artist 3');
        ";
            $trackSql = "
            INSERT INTO tracks (id, title, artistId) VALUES
            (101, 'Track 1', '1'),
            (102, 'Track 2', '1'),
            (103, 'Track 3', '2'),
            (104, 'Track 4', '3');
        ";
            $this->manager->getConnection()->executeStatement($artistSql);
            $this->manager->getConnection()->executeStatement($trackSql);
        } catch (\Exception $e) {
            $output->writeln("Error {$e->getMessage()}");
            return 1;
        }

        return 0;
    }
}
