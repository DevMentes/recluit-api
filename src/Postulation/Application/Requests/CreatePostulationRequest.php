<?php

namespace Recluit\Postulation\Application\Requests;

class CreatePostulationRequest
{
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function title(): string
    {
        return $this->title;
    }
}