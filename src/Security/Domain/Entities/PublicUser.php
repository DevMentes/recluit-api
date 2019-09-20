<?php

namespace Recluit\Security\Domain\Entities;

class PublicUser
{
    private $id;
    private $email;

    public function __construct(string $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }
}