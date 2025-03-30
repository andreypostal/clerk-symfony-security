<?php

namespace Andrey\Clerk\Value;

use Andrey\PancakeObject\Attributes\ValueObject;

#[ValueObject]
readonly class Passkeys
{
    public string $id;
    public string $object;
    public string $name;
    public int $lastUsedAt;
    public Verification $verification;
}
