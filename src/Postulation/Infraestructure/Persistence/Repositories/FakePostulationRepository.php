<?php

namespace Recluit\Postulation\Infraestructure\Persistence\Repositories;

use Recluit\Postulation\Domain\Postulation\Postulation;
use Recluit\Postulation\Domain\Postulation\PostulationRepository;

class FakePostulationRepository implements PostulationRepository
{

    public function create(Postulation $postulation): void
    {
        // TODO: Implement create() method.
    }
}