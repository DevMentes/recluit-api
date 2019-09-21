<?php

namespace Recluit\Security\Domain\Repositories;

use Recluit\Security\Domain\Entities\User;

interface UserRepository
{
    public function byEmail(string $email): ?User;

    public function create(User $user): void;
}