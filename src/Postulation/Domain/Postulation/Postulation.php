<?php

namespace Recluit\Postulation\Domain\Postulation;

class Postulation
{
    private $id;

    private $title;

    private $createdBy;

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
}