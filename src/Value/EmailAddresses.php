<?php

namespace Andrey\Clerk\Value;

use Andrey\PancakeObject\Attributes\Item;
use Andrey\PancakeObject\Attributes\ValueObject;

#[ValueObject]
readonly class EmailAddresses
{
    public string $id;
    public string $object;
    public string $emailAddress;
    public bool $reserved;
    public Verification $verification;
    /* @param LinkedTo[] $linkedTo */
    #[Item(type: LinkedTo::class)]
    public array $linkedTo;
    public bool $matchesSsoConnection;
    public int $createdAt;
    public int $updatedAt;
}
