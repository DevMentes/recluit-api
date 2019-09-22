<?php

namespace Recluit\Applications\Domain\Application;

use Recluit\Applications\Domain\Applicant\Applicant;

class Application
{
    private $id;

    private $title;

    private $createdBy;

    private $applicants = [];

    public function __construct(string $id, Title $title, string $createdBy)
    {
        $this->id = $id;
        $this->title = $title;
        $this->createdBy = $createdBy;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function createdBy(): string
    {
        return $this->createdBy;
    }

    public function addApplicant(Applicant $newApplicant): void
    {
        if ($this->applicantExists($newApplicant)) {
            throw new \DomainException("Provided applicant already exists on application.");
        }
        $this->applicants [] = $newApplicant;
    }

    /**
     * @param Applicant $newApplicant
     * @return bool
     */
    public function applicantExists(Applicant $newApplicant): bool
    {
        foreach ($this->applicants as $applicant) {
            if ($applicant->email() === $newApplicant->email()) {
                return true;
            }
        }
        return false;
    }

    public function applicants(): array
    {
        return $this->applicants;
    }
}