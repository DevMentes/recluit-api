<?php

namespace Recluit\Postulation\Application\Services;

use Recluit\Postulation\Application\Requests\AddPostulantRequest;
use Recluit\Postulation\Domain\Postulant\Postulant;
use Recluit\Postulation\Domain\Postulation\PostulationRepository;

class AddPostulantService
{
    private $postulationRepository;

    public function __construct(PostulationRepository $postulationRepository)
    {
        $this->postulationRepository = $postulationRepository;
    }

    public function execute(AddPostulantRequest $request)
    {
        $postulantId = $request->postulantId();
        $postulantName = $request->postulantName();
        $postulantSurname = $request->postulantSurname();
        $postulantEmail = $request->postulantEmail();
        $postulationId = $request->postulationId();
        $resume = $request->postulantResume();

        $postulation = $this->postulationRepository->byId($postulationId);

        if (is_null($postulation)) {
            throw new \DomainException("Postulation does not exists.");
        }

        $postulation->addPostulant(
            new Postulant(
                $postulantId,
                $postulantName,
                $postulantSurname,
                $postulantEmail,
                $resume
            )
        );

        $this->postulationRepository->save($postulation);
    }
}