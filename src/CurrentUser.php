<?php

namespace Andrey\Clerk;

use Andrey\Clerk\Value\Membership;
use Andrey\Clerk\Value\User;
use Symfony\Component\Security\Core\User\UserInterface;

readonly class CurrentUser implements UserInterface
{
    public function __construct(
        public User $user,
        public Membership $membership,
    ) {
    }

    public function getRoles(): array
    {
        return [
            'user:authenticated',
            $this->membership->role,
        ];
    }

    public function eraseCredentials(): void
    {
        throw new \Exception('not implemented');
    }

    public function getUserIdentifier(): string
    {
        return $this->user->id;
    }
}
