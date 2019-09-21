<?php

namespace Recluit\Postulation\Infraestructure\Persistence\Repositories;

use Illuminate\Database\QueryException;
use Recluit\Postulation\Domain\Postulation\Postulation;
use Recluit\Postulation\Domain\Postulation\PostulationRepository;
use Recluit\Postulation\Infraestructure\Persistence\Models\EloquentPostulations;

class EloquentPostulationRepository implements PostulationRepository
{

    public function create(Postulation $postulation): void
    {
        try {
            EloquentPostulations::create([
                "id" => $postulation->id(),
                "title" => $postulation->title(),
                "created_by" => $postulation->createdBy()
            ]);
        }catch (QueryException $exception) {
            throw $exception;
        }
    }
}