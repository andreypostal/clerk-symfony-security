<?php

namespace Andrey\Clerk\Value;

use Andrey\JsonHandler\Attributes\JsonItemAttribute;
use Andrey\JsonHandler\Attributes\JsonObjectAttribute;

#[JsonObjectAttribute]
class EmailAddresses
{
    public ?string $id;
    public ?string $object;
    public ?string $emailAddress;
    public ?bool $reserved;
    public ?Verification $verification;
    /* @param LinkedTo[] $linkedTo */
    #[JsonItemAttribute(type: LinkedTo::class)]
    public ?array $linkedTo;
    public ?bool $matchesSsoConnection;
    public ?int $createdAt;
    public ?int $updatedAt;
}
