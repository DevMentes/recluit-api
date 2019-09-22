<?php

namespace Recluit\Applications\Application\Services;

use Recluit\Applications\Application\Requests\AddApplicantRequest;
use Recluit\Applications\Domain\Applicant\Applicant;
use Recluit\Applications\Domain\Application\ApplicationRepository;

class AddApplicantService
{
    private $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function execute(AddApplicantRequest $request)
    {
        $applicantId = $request->applicantId();
        $applicantName = $request->applicantName();
        $applicantSurname = $request->applicantSurname();
        $applicantEmail = $request->applicantEmail();
        $applicationId = $request->applicationId();
        $resume = $request->applicantResume();

        $application = $this->applicationRepository->byId($applicationId);

        if (is_null($application)) {
            throw new \DomainException("Applications does not exists.");
        }

        $application->addApplicant(
            new Applicant(
                $applicantId,
                $applicantName,
                $applicantSurname,
                $applicantEmail,
                $resume
            )
        );

        $this->applicationRepository->save($application);
    }
}