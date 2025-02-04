<?php

namespace Andrey\Clerk\Value;

use Andrey\JsonHandler\Attributes\JsonItemAttribute;
use Andrey\JsonHandler\Attributes\JsonObjectAttribute;

#[JsonObjectAttribute]
class PhoneNumbers
{
    public ?string $id;
    public ?string $object;
    public ?string $phoneNumber;
    public ?bool $reservedForSecondFactor;
    public ?bool $defaultSecondFactor;
    public ?bool $reserved;
    public ?Verification $verification;
    /* @param LinkedTo[] $linkedTo */
    #[JsonItemAttribute(type: LinkedTo::class)]
    public ?array $linkedTo;
    /* @param string[] $backupCodes */
    public ?array $backupCodes;
    public ?int $createdAt;
    public ?int $updatedAt;
}
