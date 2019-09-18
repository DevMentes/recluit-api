<?php

namespace Recluit\Postulation\Domain\Postulation;

class Postulation
{
    private $title;

    public function __construct(Title $title)
    {
        $this->title = $title;
    }

    public function title(): Title
    {
        return $this->title;
    }
}