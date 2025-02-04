<?php

namespace Andrey\Clerk\Value;

use Andrey\JsonHandler\Attributes\JsonObjectAttribute;

#[JsonObjectAttribute]
class PublicUserData
{
    public ?string $userId;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $profileImageUrl;
    public ?string $imageUrl;
    public ?bool $hasImage;
    public ?string $identifier;
}
