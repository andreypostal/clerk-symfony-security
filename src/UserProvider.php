<?php

namespace Andreypostal\Clerk;

use Clerk\Backend\Models\Errors\SDKException;
use http\Exception\RuntimeException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

readonly class UserProvider implements UserProviderInterface
{
    public function __construct(
        private ClerkInterface $clerkSdk
    ) {
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }

        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class || is_subclass_of($class, User::class);
    }

    /**
     * @throws SDKException
     */
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $clientResponse = $this->clerkSdk->clients()->verify();
        $client = $clientResponse->client ?? throw new RuntimeException('invalid client');
        $userResponse = $this->clerkSdk->users()->get($identifier) ?? throw new RuntimeException('invalid user');
        $user = $userResponse->user;

        $session = $client->sessions[0];
        $orgId = $session->lastActiveOrganizationId ?? throw new RuntimeException('user must have an active org');

        $membershipResponse = $this->clerkSdk->users()->getOrganizationMemberships($identifier);
        $memberships = $membershipResponse->organizationMemberships ?? throw new RuntimeException(
            'failed fetching memberships'
        );

        $member = null;
        foreach ($memberships->data as $membership) {
            if ($membership->organization->id === $orgId) {
                $member = $membership;
                break;
            }
        }

        return new User($user, $member);
    }
}
