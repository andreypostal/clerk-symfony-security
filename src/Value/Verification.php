<?php

namespace Andrey\Clerk\Value;

use Andrey\JsonHandler\Attributes\JsonObjectAttribute;

#[JsonObjectAttribute]
class Verification
{
    public ?string $status;
    public ?string $strategy;
    public ?int $attempts;
    public ?int $expireAt;
}
