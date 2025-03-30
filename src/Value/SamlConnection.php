<?php

namespace Andrey\Clerk\Value;

use Andrey\PancakeObject\Attributes\ValueObject;

#[ValueObject]
readonly class SamlConnection
{
    public string $id;
    public string $name;
    public string $domain;
    public bool $active;
    public string $provider;
    public bool $syncUserAttributes;
    public bool $allowSubdomains;
    public bool $allowIdpInitiated;
    public bool $disableAdditionalIdentifications;
    public int $createdAt;
    public int $updatedAt;
}
