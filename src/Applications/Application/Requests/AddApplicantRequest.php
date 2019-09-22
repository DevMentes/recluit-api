<?php

namespace Recluit\Applications\Application\Requests;

class AddApplicantRequest
{
    private $applicantId;

    private $applicantName;

    private $applicantSurname;

    private $applicantEmail;

    private $applicantResume;

    private $applicationId;

    public function __construct(
        string $applicantId,
        string $applicantName,
        string $applicantSurname,
        string $applicantEmail,
        string $applicantResume,
        string $applicationId
    ) {
        $this->applicantId = $applicantId;
        $this->applicantName = $applicantName;
        $this->applicantSurname = $applicantSurname;
        $this->applicantEmail = $applicantEmail;
        $this->applicantResume = $applicantResume;
        $this->applicationId = $applicationId;
    }

    public function applicantId(): string
    {
        return $this->applicantId;
    }

    public function applicantName(): string
    {
        return $this->applicantName;
    }

    public function applicantSurname(): string
    {
        return $this->applicantSurname;
    }

    public function applicantEmail(): string
    {
        return $this->applicantEmail;
    }

    public function applicantResume(): string
    {
        return $this->applicantResume;
    }

    public function applicationId(): string
    {
        return $this->applicationId;
    }
}