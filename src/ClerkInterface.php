<?php

namespace Andreypostal\Clerk;

use Clerk\Backend\Clients;
use Clerk\Backend\Users;

interface ClerkInterface
{
    public function clients(): Clients;

    public function users(): Users;
}
