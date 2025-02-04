<?php

namespace Andrey\Clerk;

use Jose\Component\Checker\AlgorithmChecker;
use Jose\Component\Checker\ExpirationTimeChecker;
use Jose\Component\Checker\HeaderCheckerManager;
use Jose\Component\Checker\IssuedAtChecker;
use Jose\Component\Checker\NotBeforeChecker;
use Jose\Component\Core\JWT;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\ExpiredTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\InvalidPayloadException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\InvalidTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authenticator\JWTAuthenticator;
use LogicException;
use Symfony\Component\Clock\Clock;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class ClerkAuthenticator extends JWTAuthenticator
{
    public function authenticate(Request $request): Passport
    {
        $token = $this->getTokenExtractor()->extract($request);
        if ($token === false) {
            throw new LogicException(
                'Unable to extract a JWT token from the request. Also, make sure to call `supports()` before `authenticate()` to get a proper client error.'
            );
        }

        try {
            if (!$payload = $this->getJwtManager()->parse($token)) {
                throw new InvalidTokenException('Invalid JWT Token');
            }

            $clock = new Clock();
            $headerCheckerManager = new HeaderCheckerManager(
                [
                    new AlgorithmChecker(['HS256']),
                    new IssuedAtChecker($clock),
                    new NotBeforeChecker($clock),
                    new ExpirationTimeChecker($clock),
                ], []
            );

            $jwt = new readonly class($payload) implements JWT {
                public function __construct(private null|string $payload)
                {
                }

                public function getPayload(): null|string
                {
                    return $this->payload;
                }
            };

            $headerCheckerManager->check($jwt, 0);
        } catch (JWTDecodeFailureException $e) {
            if (JWTDecodeFailureException::EXPIRED_TOKEN === $e->getReason()) {
                throw new ExpiredTokenException();
            }

            throw new InvalidTokenException('Invalid JWT Token', 0, $e);
        }

        if (!isset($payload['userId'], $payload['orgId'])) {
            throw new InvalidPayloadException('userId and orgId');
        }

        $identifier = $payload['userId'] . '+' . $payload['orgId'];

        $passport = new SelfValidatingPassport(
            new UserBadge(
                $identifier,
                fn($userIdentifier) => $this->loadUser($payload, $userIdentifier)
            )
        );

        $passport->setAttribute('payload', $payload);
        $passport->setAttribute('token', $token);

        return $passport;
    }
}
