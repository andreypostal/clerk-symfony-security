<?php

namespace Andrey\Clerk\Value;

use Andrey\PancakeObject\Attributes\ValueObject;

#[ValueObject]
readonly class Membership
{
    public string $id;
    public string $object;
    public string $role;
    public string $roleName;
    /* @param string[] $permissions */
    public array $permissions;
    public array $publicMetadata;
    public array $privateMetadata;
    public Organization $organization;
    public PublicUserData $publicUserData;
    public int $createdAt;
    public int $updatedAt;
}
