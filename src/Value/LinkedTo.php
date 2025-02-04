<?php

namespace Andrey\Clerk\Value;

use Andrey\JsonHandler\Attributes\JsonObjectAttribute;

#[JsonObjectAttribute]
class LinkedTo
{
    public ?string $id;
    public ?string $type;
}
