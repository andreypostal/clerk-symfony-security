<?php

namespace Andreypostal\Clerk;

use Clerk\Backend\ClerkBackend;
use Clerk\Backend\Clients;
use Clerk\Backend\Users;

readonly class Clerk implements ClerkInterface
{
    public function __construct(private ClerkBackend $clerkSdk)
    {
    }

    public function clients(): Clients
    {
        return $this->clerkSdk->clients;
    }

    public function users(): Users
    {
        return $this->clerkSdk->users;
    }
}
