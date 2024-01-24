<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use App\Domain\ListArtistAndTrackInterface;
use Doctrine\ORM\EntityManagerInterface;

final class ListArtistAndTracksDoctrine implements ListArtistAndTrackInterface
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {
    }

    public function __invoke(): array
    {
        return $this->find();
    }

    private function find(): array
    {
        return $this->manager->getConnection()->executeQuery(<<<SQL
SELECT 
    artists.id AS artist_id, 
    artists.name AS artist_name,
    tracks.id AS track_id,
    tracks.title AS track_title
FROM artists
LEFT JOIN tracks ON artists.id = tracks.artistId;
SQL)->fetchAll();
    }
}
