<?php

namespace Andreypostal\Clerk;

use Clerk\Backend\Models\Components as Clerk;
use Symfony\Component\Security\Core\User\UserInterface;

readonly class User implements UserInterface
{
    public function __construct(
        private Clerk\User $data,
        private Clerk\OrganizationMembership $member,
    ) {
    }

    public function getRoles(): array
    {
        return [
            'user:authenticated',
            $this->member->role,
        ];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->data->id;
    }
}
