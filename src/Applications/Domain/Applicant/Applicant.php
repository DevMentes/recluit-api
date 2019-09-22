<?php

namespace Recluit\Applications\Domain\Applicant;

class Applicant
{

    private $id;

    private $name;

    private $surname;

    private $email;

    private $resume;

    public function __construct(string $id, string $name, string $surname, string $email, string $resume)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->resume = $resume;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function surname(): string
    {
        return $this->surname;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function hasResume(): bool
    {
        return strlen($this->resume) > 0 ? true : false;
    }

    public function addResume(string $resume): void
    {
        $this->resume = $resume;
    }

    public function resume(): string
    {
        return $this->resume;
    }
}