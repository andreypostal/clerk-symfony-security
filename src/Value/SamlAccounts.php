<?php

namespace Andrey\Clerk\Value;

use Andrey\JsonHandler\Attributes\JsonObjectAttribute;

#[JsonObjectAttribute]
class SamlAccounts
{
    public ?string $id;
    public ?string $object;
    public ?string $provider;
    public ?bool $active;
    public ?string $emailAddress;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $providerUserId;
    public ?array $publicMetadata;
    public ?Verification $verification;
    public ?SamlConnection $samlConnection;
}
