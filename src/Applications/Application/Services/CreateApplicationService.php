<?php

namespace Recluit\Applications\Application\Services;

use Recluit\Applications\Application\Requests\CreateApplicationRequest;
use Recluit\Applications\Domain\Application\Application;
use Recluit\Applications\Domain\Application\ApplicationRepository;
use Recluit\Applications\Domain\Application\Title;

class CreateApplicationService
{
    private $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }


    public function execute(CreateApplicationRequest $request)
    {

        $title = new Title($request->title());

        $application = new Application($request->id(), $title, $request->userId());

        $this->applicationRepository->create($application);
    }
}