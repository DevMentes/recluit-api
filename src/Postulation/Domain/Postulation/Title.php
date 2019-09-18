<?php

namespace Recluit\Postulation\Domain\Postulation;

class Title
{
    private const MIN_CHARACTERS = 10;
    private const MAX_CHARACTERS = 60;

    private $title;

    public function __construct(string $title)
    {
        $this->title = $this->isValidOrFail($title);
    }

    private function isValidOrFail(string $title) {

        if (strlen($title) < self::MIN_CHARACTERS) {
            throw new \DomainException("title should have a minimum of " . self::MIN_CHARACTERS . " characters.");
        }
        if (strlen($title) > self::MAX_CHARACTERS) {
            throw new \DomainException("title should have a maximum of " . self::MAX_CHARACTERS . " characters.");
        }
        return $title;
    }

    public function __toString()
    {
        return $this->title;
    }
}