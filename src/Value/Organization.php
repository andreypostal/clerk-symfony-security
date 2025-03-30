<?php

namespace Andrey\Clerk\Value;

use Andrey\PancakeObject\Attributes\ValueObject;

#[ValueObject]
readonly class Organization
{
    public string $object;
    public string $id;
    public string $name;
    public string $slug;
    public int $membersCount;
    public int $maxAllowedMemberships;
    public bool $adminDeleteEnabled;
    public array $publicMetadata;
    public array $privateMetadata;
    public string $createdBy;
    public int $createdAt;
    public int $updatedAt;
}
