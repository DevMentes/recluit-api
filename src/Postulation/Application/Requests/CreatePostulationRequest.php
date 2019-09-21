<?php

namespace Recluit\Postulation\Application\Requests;

class CreatePostulationRequest
{
    private $id;

    private $title;

    private $userId;

    public function __construct(string $id, string $title, string $userId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->userId = $userId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}