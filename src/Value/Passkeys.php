<?php

namespace Andrey\Clerk\Value;

use Andrey\JsonHandler\Attributes\JsonObjectAttribute;

#[JsonObjectAttribute]
class Passkeys
{
    public ?string $id;
    public ?string $object;
    public ?string $name;
    public ?int $lastUsedAt;
    public ?Verification $verification;
}
