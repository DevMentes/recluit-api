<?php

namespace Recluit\Postulation\Domain\Postulation;

use Recluit\Postulation\Domain\Postulant\Postulant;

class Postulation
{
    private $id;

    private $title;

    private $createdBy;

    private $postulants = [];

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

    public function addPostulant(Postulant $newPostulant): void
    {
        if ($this->postulantExists($newPostulant)) {
            throw new \DomainException("Provided postulant already exists on postulation.");
        }
        $this->postulants [] = $newPostulant;
    }

    /**
     * @param Postulant $newPostulant
     * @return bool
     */
    public function postulantExists(Postulant $newPostulant): bool
    {
        foreach ($this->postulants as $postulant) {
            if ($postulant->id() === $newPostulant->id()) {
                return true;
            }
        }
        return false;
    }

    public function postulants(): array
    {
        return $this->postulants;
    }
}