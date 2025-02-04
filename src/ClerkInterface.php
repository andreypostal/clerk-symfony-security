<?php

namespace Andrey\Clerk;

use Andrey\Clerk\Value\Membership;
use Andrey\Clerk\Value\User;

interface ClerkInterface
{
    public function getUser(string $userId): User;

    public function getMembership(string $userId, string $orgId): Membership;
}
