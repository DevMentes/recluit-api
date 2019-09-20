<?php

namespace Recluit\Security\Infraestructure\Persistence\Repositories;

use Recluit\Security\Domain\Entities\User;
use Recluit\Security\Domain\Repositories\UserRepository;
use Recluit\Security\Infraestructure\Persistence\Models\EloquentUser;

class EloquentUserRepository implements UserRepository
{

    public function byEmail(string $email):? User
    {
        $foundUser = EloquentUser::where("email", $email)->first();

        if (is_null($foundUser)) {
            return null;
        }

        return new User($foundUser->id, $foundUser->email, $foundUser->password);
    }

    public function create(User $user): void
    {
        $eloquentUser = new EloquentUser();
        $eloquentUser->id = $user->id();
        $eloquentUser->email = $user->email();
        $eloquentUser->password = $user->password();

        $eloquentUser->save();
    }
}