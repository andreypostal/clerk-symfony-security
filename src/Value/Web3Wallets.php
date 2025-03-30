<?php

namespace Andrey\Clerk\Value;

use Andrey\PancakeObject\Attributes\ValueObject;

#[ValueObject]
readonly class Web3Wallets
{
    public string $id;
    public string $object;
    public string $web3Wallet;
    public Verification $verification;
    public int $createdAt;
    public int $updatedAt;
}
