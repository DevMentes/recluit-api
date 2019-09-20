<?php

namespace Recluit\Security\Application\Services;

use Recluit\Security\Application\Requests\SignUpUserRequest;
use Recluit\Security\Domain\Entities\User;
use Recluit\Security\Domain\Repositories\UserRepository;

class SignUpUserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(SignUpUserRequest $request)
    {
        $id = $request->id();
        $email = $this->emailIsValidOrFail($request->email());;
        $password = $this->passwordIsValidOrFail($request->password());

        $foundUser = $this->userRepository->byEmail($email);

        if (!is_null($foundUser)) {
            throw new \DomainException("email is already registered.");
        }

        $user = new User($id, $email, $this->hashPassword($password));

        $this->userRepository->create($user);
    }

    private function emailIsValidOrFail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \DomainException("email must be valid.");
        }
        return $email;
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    private function passwordIsValidOrFail(string $password)
    {
        if (strlen($password) < 8) {
            throw new \DomainException("The password must be greater than 8 characters.");
        }
        return $password;
    }
}