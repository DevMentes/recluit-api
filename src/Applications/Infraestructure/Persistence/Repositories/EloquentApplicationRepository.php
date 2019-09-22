<?php

namespace Recluit\Applications\Infraestructure\Persistence\Repositories;

use Illuminate\Database\QueryException;
use Recluit\Applications\Domain\Applicant\Applicant;
use Recluit\Applications\Domain\Application\Application;
use Recluit\Applications\Domain\Application\ApplicationRepository;
use Recluit\Applications\Domain\Application\Title;
use Recluit\Applications\Infraestructure\Persistence\Models\EloquentApplicant;
use Recluit\Applications\Infraestructure\Persistence\Models\EloquentApplication;

class EloquentApplicationRepository implements ApplicationRepository
{

    public function create(Application $application): void
    {
        try {
            EloquentApplication::create([
                "id" => $application->id(),
                "title" => $application->title(),
                "created_by" => $application->createdBy()
            ]);
        } catch (QueryException $exception) {
            throw $exception;
        }
    }

    public function byId(string $id): ?Application
    {
        $eloquentApplication = EloquentApplication::find($id);

        if (is_null($eloquentApplication)) {
            return null;
        }

        $application = new Application(
            $eloquentApplication->id,
            new Title($eloquentApplication->title),
            $eloquentApplication->createdBy()->id
        );

        foreach ($eloquentApplication->applicants()->get() as $applicant) {
            $application->addApplicant(
                new Applicant(
                    $applicant->id,
                    $applicant->name,
                    $applicant->surname,
                    $applicant->email,
                    $applicant->resume
                )
            );
        }

        return $application;
    }

    public function save(Application $application): void
    {
        $eloquentApplication = new EloquentApplication([
            "id" => $application->id(),
            "title" => $application->title(),
            "created_by" => $application->createdBy()
        ]);

        $eloquentApplicants = [];

        foreach ($application->applicants() as $applicant) {
            $eloquentApplication->applicants()->updateOrCreate([
                "id" => $applicant->id(),
                "name" => $applicant->name(),
                "surname" => $applicant->surname(),
                "email" => $applicant->email(),
                "resume" => $applicant->resume()
            ]);
        }

        try {
            $eloquentApplication->update();
        } catch (QueryException $exception) {
            throw $exception;
        }

    }
}