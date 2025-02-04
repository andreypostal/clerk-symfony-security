<?php

namespace Andrey\Clerk;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

readonly class UserProvider implements UserProviderInterface
{
    public const string IdSeparator = '+';

    public function __construct(
        private ClerkInterface $clerk
    ) {
    }

    public function combineIds(string $userId, string $orgId): string
    {
        return $userId . self::IdSeparator . $orgId;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof CurrentUser) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }

        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return CurrentUser::class === $class || is_subclass_of($class, CurrentUser::class);
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        [$userId, $orgId] = explode(self::IdSeparator, $identifier);
        $user = $this->clerk->getUser($userId);
        $membership = $this->clerk->getMembership($userId, $orgId);

        return new CurrentUser($user, $membership);
    }
}
