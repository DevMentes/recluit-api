<?php

namespace Recluit\Postulation\Application\Requests;

class AddPostulantRequest
{
    private $postulantId;

    private $postulantName;

    private $postulantSurname;

    private $postulantEmail;

    private $postulantResume;

    private $postulationId;

    public function __construct(
        string $postulantId,
        string $postulantName,
        string $postulantSurname,
        string $postulantEmail,
        string $postulantResume,
        string $postulationId
    ) {
        $this->postulantId = $postulantId;
        $this->postulantName = $postulantName;
        $this->postulantSurname = $postulantSurname;
        $this->postulantEmail = $postulantEmail;
        $this->postulantResume = $postulantResume;
        $this->postulationId = $postulationId;
    }

    public function postulantId(): string
    {
        return $this->postulantId;
    }

    public function postulantName(): string
    {
        return $this->postulantName;
    }

    public function postulantSurname(): string
    {
        return $this->postulantSurname;
    }

    public function postulantEmail(): string
    {
        return $this->postulantEmail;
    }

    public function postulantResume(): string
    {
        return $this->postulantResume;
    }

    public function postulationId(): string
    {
        return $this->postulationId;
    }
}