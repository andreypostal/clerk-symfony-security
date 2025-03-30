<?php

namespace Andrey\Clerk\Value;

use Andrey\PancakeObject\Attributes\Item;
use Andrey\PancakeObject\Attributes\ValueObject;

#[ValueObject]
readonly class PhoneNumbers
{
    public string $id;
    public string $object;
    public string $phoneNumber;
    public bool $reservedForSecondFactor;
    public bool $defaultSecondFactor;
    public bool $reserved;
    public Verification $verification;
    /* @param LinkedTo[] $linkedTo */
    #[Item(type: LinkedTo::class)]
    public array $linkedTo;
    /* @param string[] $backupCodes */
    public array $backupCodes;
    public int $createdAt;
    public int $updatedAt;
}
