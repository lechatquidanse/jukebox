<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use App\Domain\FindTrackInterface;
use App\Domain\Track;
use Doctrine\ORM\EntityManagerInterface;

final class FindTrackDoctrine implements FindTrackInterface
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {
    }

    public function __invoke(int $number): Track|null
    {
        return $this->manager->find(Track::class, $number);
    }
}
