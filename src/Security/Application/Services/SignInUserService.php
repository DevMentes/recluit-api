<?php

namespace Recluit\Security\Application\Services;

use Recluit\Security\Application\Requests\SignInUserRequest;
use Recluit\Security\Domain\Entities\PublicUser;
use Recluit\Security\Domain\Entities\User;
use Recluit\Security\Domain\Repositories\UserRepository;

class SignInUserService
{
    private $userRepository;

    private const INVALID_CREDENTIALS_ERROR = "Invalid credentials are provided.";

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(SignInUserRequest $request): PublicUser
    {
        $email = $this->emailIsValidOrFail($request->email());
        $password = $request->password();

        $foundUser = $this->userRepository->byEmail($email);

        if ($foundUser === null) {
            throw new \DomainException(self::INVALID_CREDENTIALS_ERROR);
        }

        if (!$this->validateCredentialsForUser($foundUser, $password)) {
            throw new \DomainException(self::INVALID_CREDENTIALS_ERROR);
        }

        return new PublicUser($foundUser->id(), $foundUser->email());
    }

    private function emailIsValidOrFail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \DomainException("email must be valid.");
        }
        return $email;
    }

    private function validateCredentialsForUser(User $foundUser, string $password): bool
    {
        return password_verify($password, $foundUser->password());
    }
}