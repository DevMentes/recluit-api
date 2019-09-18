<?php

namespace Recluit\Postulation\Application\Services;

use Recluit\Postulation\Application\Requests\CreatePostulationRequest;
use Recluit\Postulation\Domain\Postulation\Postulation;
use Recluit\Postulation\Domain\Postulation\Title;
use Recluit\Postulation\Domain\Postulation\PostulationRepository;

class CreatePostulationService
{
    private $postulationRepository;

    public function __construct(PostulationRepository $postulationRepository)
    {
        $this->postulationRepository = $postulationRepository;
    }

    public function execute(CreatePostulationRequest $request) {

        $title = new Title($request->title());

        $postulation = new Postulation($title);

        $this->postulationRepository->create($postulation);
    }
}