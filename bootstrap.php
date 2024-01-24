<?php

require './vendor/autoload.php';

use App\Domain\PlayTrack;
use App\Infrastructure\Doctrine\FindTrackDoctrine;
use App\Infrastructure\Doctrine\ListArtistAndTracksDoctrine;
use App\Infrastructure\InMemory\FindTrackInMemory;
use App\Infrastructure\InMemory\ListArtistAndTracksInMemory;
use App\Infrastructure\InMemory\InMemory;
use App\Infrastructure\InMemory\QueueRepositoryInMemory;
use App\Infrastructure\Json\QueueRepositoryJson;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$config = ORMSetup::createXMLMetadataConfiguration(
   paths: array(__DIR__."/src/Infrastructure/Doctrine/Config/"),
   isDevMode: true,
);

$connection = DriverManager::getConnection([
    'dbname' => 'database',
    'user' => 'user',
    'password' => 'pass',
    'host' => 'db',
    'driver' => 'pdo_mysql',
], $config);

$entityManager = new EntityManager($connection, $config);
$inMemory = InMemory::filled();
$queueRepository = new QueueRepositoryJson();
$listArtistAndTracks = new ListArtistAndTracksDoctrine($entityManager);
$playTrack = new PlayTrack(
    findTrack: new FindTrackDoctrine($entityManager),
    queueRepository: $queueRepository,
);