<?php

namespace Andrey\Clerk\Value;

use Andrey\PancakeObject\Attributes\ValueObject;

#[ValueObject]
readonly class LinkedTo
{
    public string $id;
    public string $type;
}
