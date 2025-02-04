<?php

namespace Andrey\Clerk\Value;

use Andrey\JsonHandler\Attributes\JsonObjectAttribute;

#[JsonObjectAttribute]
class Organization
{
    public ?string $object;
    public ?string $id;
    public ?string $name;
    public ?string $slug;
    public ?int $membersCount;
    public ?int $maxAllowedMemberships;
    public ?bool $adminDeleteEnabled;
    public ?array $publicMetadata;
    public ?array $privateMetadata;
    public ?string $createdBy;
    public ?int $createdAt;
    public ?int $updatedAt;
}
