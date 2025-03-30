<?php

namespace Andrey\Clerk\Value;

use Andrey\PancakeObject\Attributes\ValueObject;

#[ValueObject]
readonly class Verification
{
    public string $status;
    public string $strategy;
    public int $attempts;
    public int $expireAt;
}
