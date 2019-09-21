<?php

namespace Recluit\Postulation\Application\Services;

use Recluit\Postulation\Application\Requests\CreatePostulationRequest;
use Recluit\Postulation\Domain\Postulation\Postulation;
use Recluit\Postulation\Domain\Postulation\PostulationRepository;
use Recluit\Postulation\Domain\Postulation\Title;

class CreatePostulationService
{
    private $postulationRepository;

    public function __construct(PostulationRepository $postulationRepository)
    {
        $this->postulationRepository = $postulationRepository;
    }


    public function execute(CreatePostulationRequest $request)
    {

        $title = new Title($request->title());

        $postulation = new Postulation($request->id(), $title, $request->userId());

        $this->postulationRepository->create($postulation);
    }
}