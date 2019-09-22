<?php

namespace Recluit\Postulation\Infraestructure\Persistence\Repositories;

use Illuminate\Database\QueryException;
use Recluit\Postulation\Domain\Postulant\Postulant;
use Recluit\Postulation\Domain\Postulation\Postulation;
use Recluit\Postulation\Domain\Postulation\PostulationRepository;
use Recluit\Postulation\Domain\Postulation\Title;
use Recluit\Postulation\Infraestructure\Persistence\Models\EloquentPostulant;
use Recluit\Postulation\Infraestructure\Persistence\Models\EloquentPostulation;

class EloquentPostulationRepository implements PostulationRepository
{

    public function create(Postulation $postulation): void
    {
        try {
            EloquentPostulation::create([
                "id" => $postulation->id(),
                "title" => $postulation->title(),
                "created_by" => $postulation->createdBy()
            ]);
        } catch (QueryException $exception) {
            throw $exception;
        }
    }

    public function byId(string $id): ?Postulation
    {
        $eloquentPostulation = EloquentPostulation::find($id);

        if (is_null($eloquentPostulation)) {
            return null;
        }

        $postulation = new Postulation(
            $eloquentPostulation->id,
            new Title($eloquentPostulation->title),
            $eloquentPostulation->createdBy()->id
        );

        foreach ($eloquentPostulation->postulants() as $postulant) {
            $postulation->addPostulant(
                new Postulant(
                    $postulant->id,
                    $postulant->name,
                    $postulant->surname,
                    $postulant->email,
                    $postulant->resume
                )
            );
        }

        return $postulation;
    }

    public function save(Postulation $postulation): void
    {
        $eloquentPostulants = [];

        foreach ($postulation->postulants() as $postulant) {
            $eloquentPostulants [] = EloquentPostulant::create([
                "id" => $postulant->id(),
                "name" => $postulant->name(),
                "surname" => $postulant->surname(),
                "email" => $postulant->email(),
                "resume" => $postulant->resume()
            ]);
        }

        $eloquentPostulation = new EloquentPostulation();
        $eloquentPostulation->id = $postulation->id();
        $eloquentPostulation->title = $postulation->title();
        $eloquentPostulation->createMany($eloquentPostulants);
        try {
            $eloquentPostulation->save();
        } catch (QueryException $exception) {
            throw $exception;
        }
    }
}