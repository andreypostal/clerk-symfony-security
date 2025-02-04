<?php

namespace Andrey\Clerk\Value;

use Andrey\JsonHandler\Attributes\JsonItemAttribute;
use Andrey\JsonHandler\Attributes\JsonObjectAttribute;

#[JsonObjectAttribute]
class User
{
    public ?string $id;
    public ?string $object;
    public ?string $externalId;
    public ?string $primaryEmailAddressId;
    public ?string $primaryPhoneNumberId;
    public ?string $primaryWeb3WalletId;
    public ?string $username;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $profileImageUrl;
    public ?string $imageUrl;
    public ?bool $hasImage;
    public ?array $publicMetadata;
    public ?array $privateMetadata;
    public ?array $unsafeMetadata;
    /* @param EmailAddresses[] $emailAddresses */
    #[JsonItemAttribute(type: EmailAddresses::class)]
    public ?array $emailAddresses;
    /* @param PhoneNumbers[] $phoneNumbers */
    #[JsonItemAttribute(type: PhoneNumbers::class)]
    public ?array $phoneNumbers;
    /* @param Web3Wallets[] $web3Wallets */
    #[JsonItemAttribute(type: Web3Wallets::class)]
    public ?array $web3Wallets;
    /* @param Passkeys[] $passkeys */
    #[JsonItemAttribute(type: Passkeys::class)]
    public ?array $passkeys;
    public ?bool $passwordEnabled;
    public ?bool $twoFactorEnabled;
    public ?bool $totpEnabled;
    public ?bool $backupCodeEnabled;
    public ?int $mfaEnabledAt;
    public ?int $mfaDisabledAt;
    public ?array $externalAccounts;
    /* @param SamlAccounts[] $samlAccounts */
    #[JsonItemAttribute(type: SamlAccounts::class)]
    public ?array $samlAccounts;
    public ?int $lastSignInAt;
    public ?bool $banned;
    public ?bool $locked;
    public ?int $lockoutExpiresInSeconds;
    public ?int $verificationAttemptsRemaining;
    public ?int $updatedAt;
    public ?int $createdAt;
    public ?bool $deleteSelfEnabled;
    public ?bool $createOrganizationEnabled;
    public ?int $createOrganizationsLimit;
    public ?int $lastActiveAt;
    public ?int $legalAcceptedAt;
}
